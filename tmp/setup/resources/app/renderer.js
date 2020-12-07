const electron = require('electron');
const shell = electron.shell;
const remote = electron.remote;
const dialog = remote.dialog;
const os = require('os');
const fs = require("fs");
const fs_extra = require('fs-extra');
const path = require('path');
const execSync = require('child_process').execSync;
const iconv = require("iconv-lite");

const UTF_8 = 'utf-8';
const SHIFT_JIS = 'Shift_JIS';
const PLEIADES_PKG_NAME = 'jp.sourceforge.mergedoc.pleiades';
const isMac = process.platform === 'darwin';
const isWin = process.platform === 'win32';
const homeDir = process.env[process.platform == "win32" ? "USERPROFILE" : "HOME"];

let appPath = null;
let vmoptionsFileName = null;
let versionFileName = null;

// Pleiades コピー元ディレクトリ
let pleiadesDir = _getPleiadesDir();
if (pleiadesDir == null) {
    dialog.showErrorBox('エラー', 'インストーラーに Pleiades が含まれていないため実行できません。');
    remote.getCurrentWindow().close();
}

// バージョンを取得して表示
fs.readdir(pleiadesDir, function(err, files){
    if (err) throw err;
    for(let i = 0; i < files.length; i++) {
        let f = files[i];
        if (f.match(/pleiades-.+/)) {
            let v = f.replace(/pleiades-(.+)/, '$1');
            $('#v-value').text(v);
            versionFileName = f;
            return;
        }
    }
    dialog.showErrorBox('エラー', 'インストーラーに pleiades-* が含まれていないため実行できません。');
    remote.getCurrentWindow().close();
});

// 選択ダイアログを開く
var $selectButton = $('#selectButton');
$selectButton.on('click', () => {

    $selectButton.prop('disabled', true);
    let options = {
        properties: ['openFile'],
    };
    if (isMac) {
        options.message = '日本語化するアプリケーションの選択 (app)';
        options.filters = [{name: 'アプリケーション (app)', extensions: ['app']}];
    } else {
        options.title = '日本語化するアプリケーションの選択 (exe)';
        options.filters = [{name: 'アプリケーション', extensions: ['exe']}];
    }
    dialog.showOpenDialog(null, options, (fileNames) => {

        $selectButton.prop('disabled', false);
        vmoptionsFileName = null;
        $('#execButton').show().prop('disabled', true);
        $('#destPath').val('');
        $('#iniPath').val('');
        $('#filePathGroup').removeClass('has-error');

        if (fileNames && fileNames.length > 0) {
            appPath = fileNames[0];
            $('#filePath').val(appPath);
            try {
                _setConfigPath();
                $progressBar.css({
                    'visibility':'hidden',
                    'width':'0%'
                });
                $('#execButton').prop('disabled', false).focus();
            } catch (error) {
                $('#filePathGroup').addClass('has-error');
                dialog.showErrorBox('エラー', error.message || error);
            }
        }
    });
    // Mac で cencel エラーにならないように false を返す
    return false;
});

// アプリケーションのパスを設定する
function _setConfigPath() {

    // 2020.1 以降 (Android 4.1 以降：未確認)
    const AFTER_2020_PNAME = /^(AndroidStudio(4\.[1-9]|[5-9]\..+)|[A-z]+202.+)$/;

    if (isMac) {
        let plist = path.join(appPath, 'Contents', 'Info.plist');
        let plistText = fs.readFileSync(plist, UTF_8);
    
        // IDEA 製品ディレクトリ名 - idea.paths.selector
        let pname = plistText.replace(/[\s\S]+>idea.paths.selector<[\s\S]+?<string>(.+?)<[\s\S]+/, '$1');
        if (pname && !pname.match(/</)) {

            let configDir = path.join(homeDir, 'Library/Preferences', pname);
            if (pname.match(AFTER_2020_PNAME)) {
                if (pname.includes('Android')) {
                    configDir = path.join(homeDir, 'Library/Application Support/Google', pname);
                } else {
                    configDir = path.join(homeDir, 'Library/Application Support/JetBrains', pname);
                }
            }
            $('#destPath').val(configDir);

            // ベース名 idea, phpstorm,,, - idea.executable
            let ename = plistText.replace(/[\s\S]+>idea.executable<[\s\S]+?<string>(.+?)<[\s\S]+/, '$1');
            if (ename && !ename.match(/</)) {

                // Toolbox の場合は app と同じ場所 (studio 3.5 以降は Toolbox でない場合と同じ)
                let vmoptions = appPath + '.vmoptions';
                if (_exist(vmoptions) && ename != 'studio') {
                    vmoptionsFileName = path.basename(vmoptions);
                }
                // Toolbox でない場合は構成ディレクトリ
                else {
                    vmoptionsFileName = ename + '.vmoptions';
                    vmoptions = path.join(configDir, vmoptionsFileName);
                }
                $('#iniPath').val(vmoptions);
                setOpenLink(ename);
                return;
            }
        }
        // Eclipse
        else {
            let dest = path.join(appPath, 'Contents/Eclipse/dropins/MergeDoc/eclipse/plugins');

            // ベース名 eclipse, STS,,, - CFBundleExecutable
            let ename = plistText.replace(/[\s\S]+>CFBundleExecutable<[\s\S]+?<string>(.+?)<[\s\S]+/, '$1');
            let ini = path.join(appPath, 'Contents/Eclipse/' + ename + '.ini');
            if (_exist(ini)) {
                $('#destPath').val(dest);
                $('#iniPath').val(ini);
                return;
            }
        }
    }
    // Windows
    else {
        // IDEA
        let ideaProp = path.join(appPath, '../idea.properties');
        if (_exist(ideaProp)) {

            // 製品ディレクトリ名 - idea.paths.selector
            let pname = null;
            let bat = appPath.replace(/(|64)\.exe$/, '.bat');
            if (_exist(bat)) {
                let text = fs.readFileSync(bat, UTF_8);
                pname = text.replace(/[\s\S]+Didea.paths.selector=(.+?) [\s\S]+/, '$1');
            } else {
                // studio2.3 以前は bat が無いため、デフォルト vmoptions から取得
                let text = fs.readFileSync(appPath + '.vmoptions', UTF_8);
                pname = text.replace(/[\s\S]+Didea.paths.selector=(.+?)[\r\n][\s\S]+/, '$1');
            }
            if (pname && !pname.match(/=/)) {
                let configDir = path.join(homeDir, '.' + pname, 'config');

                // studio の場合は 3.1 より前は config なし
                if (pname.match(/AndroidStudio(2\.[0-9]|3\.0)/)) {
                    configDir = path.join(homeDir, '.' + pname);
                }
                // 2020.1 以降
                else if (pname.match(AFTER_2020_PNAME)) {
                    if (pname.includes('Android')) {
                        configDir = path.join(homeDir, 'AppData/Roaming/Google', pname);
                    } else {
                        configDir = path.join(homeDir, 'AppData/Roaming/JetBrains', pname);
                    }
                }

                $('#destPath').val(configDir);
                let ename = path.basename(appPath);

                // Toolbox の場合 (Mac と同じように 3.5 以降対応が必要か確認中)
                let vmoptions = path.join(appPath, '../..') + '.vmoptions';
                if (_exist(vmoptions)) {
                    vmoptionsFileName = path.basename(vmoptions);
                }
                // Toolbox でない場合
                else {
                    // ベース名 idea64.exe, phpstorm64.exe,,, - exe ファイル名から
                    vmoptionsFileName = ename + '.vmoptions';
                    vmoptions = path.join(configDir, vmoptionsFileName);
                }
                $('#iniPath').val(vmoptions);
                setOpenLink(ename.replace(/(|64)\.exe$/, ''));
                return;
            }
        }
        // Eclipse
        else {
            let dest = path.join(appPath, '../dropins/MergeDoc/eclipse/plugins');

            // ベース名 eclipse, STS,,,
            let basename = path.basename(appPath, '.exe');
            let ini = path.join(appPath, '../' + basename + '.ini');
            if (_exist(ini)) {
                $('#destPath').val(dest);
                $('#iniPath').val(ini);
                return;
            }
        }
    }
    throw "Pleiades で日本語化可能なアプリケーションを指定してください。";
}

function setOpenLink(ename) {
    let nameMap = {
        'idea'      : {path:'idea',     name:'IntelliJ IDEA'},
        'phpstorm'  : {path:'phpstorm', name:'PhpStorm'},
        'pycharm'   : {path:'pycharm',  name:'PyCharm'},
        'rubymine'  : {path:'ruby',     name:'RubyMine'},
        'clion'     : {path:'clion',    name:'CLion'},
        'appcode'   : {path:'objc',     name:'AppCode'},
        'webstorm'  : {path:'webstorm', name:'WebStorm'},
        'rider'     : {path:'rider',    name:'Rider'},
        'goland'    : {path:'go',       name:'GoLand'},
    };
    let prod = nameMap[ename];
    if (!prod) {
        return;
    }
    $('#openLink')
        .attr('href', 'https://pleiades.io/help/' + prod.path)
        .text(prod.name + ' 日本語マニュアル ▶')
        .addClass('flash btn-primary')
    ;
}

// 終了する
$quitButton = $('#quitButton');
$quitButton.on('click', () => {
    remote.getCurrentWindow().close();
});

// 日本語化クリック
var $progressBar = $('.progress-bar');
var $execButton = $('#execButton');
$execButton.on('click', () => {

    $progressBar.css({
        'visibility':'visible',
        'width':'100%'
    });
    $execButton.prop('disabled', true);
    $quitButton.prop('disabled', true);
    $selectButton.prop('disabled', true);

    setTimeout(_execInstall, 500);
});

// 日本語化を実行する
function _execInstall() {
    try {
        let isEclipse = vmoptionsFileName == null;
        let isIdea = !isEclipse;
        let destPath = $('#destPath').val();
        if (destPath == null) {
            return;
        }

        //---------------------------------------------------------------------------------
        // Pleiades プラグイン本体をコピー
        //---------------------------------------------------------------------------------

        let pluginsPkgDir = path.join(pleiadesDir, 'plugins', PLEIADES_PKG_NAME);
        let destPluginsPkgDir = path.join(destPath, PLEIADES_PKG_NAME);
        _copyDirectoryOverwrite(pluginsPkgDir, destPluginsPkgDir);
        fs_extra.removeSync(path.join(destPluginsPkgDir, 'cache'));

        // バージョンファイル
        let versionFile = path.join(pleiadesDir, versionFileName);

        if (isEclipse) {

            // フィーチャーのコピー
            let featuresPkgDir = path.join(pleiadesDir, 'features', PLEIADES_PKG_NAME);
            let destFeaturesPkgDir = path.join(destPath, '..', 'features', PLEIADES_PKG_NAME);
            _copyDirectoryOverwrite(featuresPkgDir, destFeaturesPkgDir);
    
            // Windows 用の -clean コマンドファイルをコピー
            if (isWin) {
                // basename は eclipse, STS など
                let basename = path.basename(appPath, '.exe');
                let fileName = 'eclipse.exe -clean.cmd';
                let srcCmd = path.join(pleiadesDir, 'eclipse.exe -clean.cmd');
                let destCmd = path.join(appPath, '..', basename + '.exe -clean.cmd');

                let text = _readFile(srcCmd);
                text = text.replace(/eclipse/g, basename);
                _writeFile(destCmd, text);
            }

            // バージョンファイル (Eclipse) -> plugins があるディレクトリ
            fs_extra.copySync(versionFile, path.join(destPath, '..', versionFileName));
        } else {
            // バージョンファイル (IDEA) -> jp.〜.pleiades の中
            fs_extra.copySync(versionFile, path.join(destPath, PLEIADES_PKG_NAME, versionFileName));
        }

        //---------------------------------------------------------------------------------
        // ini, vmoptions ファイルの編集
        //---------------------------------------------------------------------------------

        let iniFile = $('#iniPath').val();
        let optVerify = '-Xverify:none';
        let optAgent = null;
        if (isEclipse) {
            let dropinsJar = 'dropins/MergeDoc/eclipse/plugins/jp.sourceforge.mergedoc.pleiades/pleiades.jar';
            if (isMac) {
                optAgent = '-javaagent:../Eclipse/' + dropinsJar;
            } else {
                optAgent = '-javaagent:' + dropinsJar;
            }
        } else {
            // IDEA はフルパス
            optAgent = '-javaagent:' + path.join(destPluginsPkgDir, 'pleiades.jar');
        }
    
        // IDEA、Eclipse 共通 (Eclipse は選択時に存在チェック済みのため必ず存在する前提)
        if (isEclipse || _exist(iniFile)) {

            let text = _readFile(iniFile);
            let upd = false;

            // eclipse.ini の showsplash コメントアウト (初回のみ)
            if (isEclipse && !text.match(/-javaagent:.+pleiades.jar/)) {
                text = text.replace(/\n(-showsplash)([\r\n]+)(org.eclipse.epp.package.common)/, '\n#$1$2#$3');
                upd = true;
            }
            if (!text.match(new RegExp('\n' + optVerify))) {
                text = _appendLine(text, optVerify);
                upd = true;
            }
            let _slash = (s) => s.replace(/\\/g, '/');
            if (!_slash(text).match(new RegExp('\n' + _slash(optAgent)))) {
                // パスが異なる有効な javaagent がある場合はコメントアウト
                text = text.replace(/\n(-javaagent:.+pleiades.jar)/, '\n#$1');
                text = _appendLine(text, optAgent);
                upd = true;
            }
            if (upd) {
                _writeFile(iniFile, text);
            }
        }
        // IDEA で存在しない場合、デフォルトからコピー
        else {
            let srcVmoptions = isMac
                ? path.join(appPath, 'Contents/bin', vmoptionsFileName)
                : path.join(appPath, '..', vmoptionsFileName)
            ;
            let text = _readFile(srcVmoptions);
            // コメント削除
            text = text.replace(/^#.*[\r\n]+/gm, '');
            let head =
                '# Custom VM options (Generated by Pleiades Installer)' + os.EOL +
                '# See https://pleiades.io/pages/pleiades_jetbrains_manual.html' + os.EOL;
            text = head + text;
            // ヒープサイズ指定をコメントアウト (デフォルト：物理サイズの 1/4 か 4GB の小さいほう)
            text = text.replace(/\n(-Xm[sx][0-9]+[a-z])/g, '\n#$1');
            text = _appendLine(text, optVerify);
            text = _appendLine(text, optAgent);
            _writeFile(iniFile, text);
        }

        // Mac IDEA のメニュー言語設定を日本語にする (起動時に LauncherIdeaTransformer でも処理)
        // → [github#32] GitHub 連携で Missing Access Token となるため廃止 2019.09.15
        /*
        if (isMac && isIdea) {
            let plist = path.join(appPath, 'Contents', 'Info.plist');
            let plistText = _readFile(plist);
            plistText = plistText.replace(/<string>English</, '<string>Japanese<');
            _writeFile(plist, plistText);
        }
        */

        // Mac の Gatekeeper エラーダイアログの防止 (eclipse.ini や Info.plist を改変しているため)
        if (isMac) {
            try {
                // 空白が含まれるディレクトリに対応するために " で囲む
                execSync('xattr -crs "' + appPath + '"');
            } catch (e) {
                console.log(e);
            }
        }
    
        $selectButton.prop('disabled', false);
        $execButton.hide();
        $quitButton.prop('disabled', false).text('終了').focus();
        let _msg = '日本語化が完了しました。' +
            '他のアプリケーションを選択することで続けて日本語化できます。' +
            '日本語化した後は、このインストーラーを削除しても問題ありません。';
        dialog.showMessageBox(null, {title:'情報', message:_msg}, () => {});
                
    } catch (error) {

        console.log(error);
        dialog.showErrorBox('エラー', error.message || error);
        $execButton.prop('disabled', false);
        $progressBar.css({
            'visibility':'hidden',
            'width':'0%'
        });
    }
}

// テキストに行を追加する
function _appendLine(text, addition) {
    text = text.replace(/[\r\n\s]+$/, '');
    text += os.EOL + addition + os.EOL;
    return text;
}

// コピー元 Pleiades ディレクトリを取得する
function _getPleiadesDir() {
    let p = __dirname;
    while (path.join(p, '..') != p) {
        p = path.join(p, '..');
        let pdir = path.join(p, 'plugins', PLEIADES_PKG_NAME);
        if (_exist(pdir)) {
            return p;
        }
    }
    return null;
}

// ディレクトリをコピーする
function _copyDirectoryOverwrite(srcDir, dstDir) {
    try {
        fs_extra.copySync(srcDir, dstDir);
    } catch (error) {
        // ロックは Windows のみで発生
        if (error.code == 'EBUSY') {
            throw 'ファイルがロックされています。\n' +
            '対象のアプリケーションが起動している場合は終了して再度実行してください。';
        }
        throw error;
    }
}

// ファイルの存在チェックを行う
function _exist(file) {
    try {
        fs.statSync(file);
        return true
    } catch(err) {
        return false
    }
}

// 外部ブラウザを開く
$(document).on('click', 'a', e => {
    var $a = $(e.target);
    shell.openExternal($a.attr('href'));   
    return false;
});

function _readFile(path) {
    if (isWin) {
        let buf = new Buffer(fs.readFileSync(path), 'binary');
        return iconv.decode(buf, SHIFT_JIS);
    } else {
        return fs.readFileSync(path, UTF_8);
    }
}

function _writeFile(path, text) {
    if (isWin) {
        let writer = fs.createWriteStream(path);
        writer.write(iconv.encode(text, SHIFT_JIS));
        writer.end();
    } else {
        fs.writeFileSync(path, text, UTF_8);
    }
}
