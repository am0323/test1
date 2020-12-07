━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Pleiades
──────────────────────────────────────────────────
URL    : http://mergedoc.osdn.jp/
MAIL   : kashihara @ me.com
AUTHOR : Shinji Kashihara (cypher256: 柏原 真二)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Pleiades は Eclipse や IntelliJ などを日本語化するプラグインです。
実行時にメモリ上で IDE 本体と多くのプラグインを日本語化します。



特徴
──────────────────────────────────────────────────

  ・翻訳対象のプラグインやバージョン（Eclipse 本体含む）に依存しません。
  ・リソースが外部化されていないプラグインでも日本語化されます。
  ・対象プラグインのプロパティファイルやクラスファイルは書き換えません。
  ・言語パックを入れた場合、その部分に関しては言語パックが優先(*1)されます。
  ・JDK の標準 API Javadoc ホバーを日本語化します(*2)。
  ・ヘルプは日本語化されません。
  ・実際はプラグインではなく、AOP を利用した翻訳コンテナです。


  (*1) Pleiades は基本的に Eclipse.org が配布する言語パックをすべて取り込み済みですが、言語パックが
       持つ明らかにおかしいと思われる訳は修正しています。言語パックを入れた場合、それらの恩恵は受け
       られません。なお、言語パックをインストール済みでも優先したくない場合は、Eclipse の起動時に
       -nl en_us（これは Eclipse が持つオプションです）を指定することですべて Pleiades 側で訳されます。

  (*2) Eclipse 3.2以降、Pleiades 1.2.1 以降。jar に日本語の API 日本語ドキュメントを設定した場合のみ
      （自動的にデフォルトで日本語版の URL が設定されます）。Eclipse 3.2 以降では jar に設定した API
       ドキュメントをホバー表示できますが、ソースを添付していた場合はそれが優先されてしまいます。
       Pleiades はその優先度を逆転させています。



翻訳ポリシー
──────────────────────────────────────────────────

  こちらの本家 eclipse.org Wiki で策定しています。
  http://wiki.eclipse.org/%E7%BF%BB%E8%A8%B3%E3%83%AB%E3%83%BC%E3%83%AB



動作環境
──────────────────────────────────────────────────

  バージョン 2017.07.23 以降

  ・JRE 8 以上
  ・Eclipse 4.5 以上

  バージョンが上記より前 (1.7.27 が最終で、それ以降はバージョンが日付表記になりました)

  ・JRE 6 以上
  ・Eclipse 3.1 以上



IntelliJ などへのインストール
──────────────────────────────────────────────────

  JetBrains 製の IDE (IntelliJ, PhpStorm, RubyMine, PyCharm, CLion, Android Studio など) を
  日本語化する場合は、以下の日本語化マニュアルを参照してください。

    https://pleiades.io/pages/pleiades_jetbrains_manual.html

  <Pleiades キャッシュ・ディレクトリ> の場所

    Windows C:/Users/(ユーザ名)/.<製品名+バージョン>/config/jp.sourceforge.mergedoc.pleiades/cache
    macOS   /Users/(ユーザ名)/Library/Preferences/<製品名+バージョン>/jp.sourceforge.mergedoc.pleiades/cache
    *nix    /home/(ユーザ名)/.<製品名+バージョン>/config/jp.sourceforge.mergedoc.pleiades/cache



Eclipse へのインストール
──────────────────────────────────────────────────

  Windows 版と Mac 版はインストーラーが付属しています。手動または Linux の場合は、
  以下の手順に従ってインストールしてください。

  1. pleiades_x.x.x.zip を解凍し、plugins、features ディレクトリーを <ECLIPSE_HOME> ディレクトリーに
     コピー。(<ECLIPSE_HOME> は Eclipse デフォルトの plugins や features があるディレクトリー)

  2. eclipse.ini の最終行に以下の 2 行を追加。Xverify は Eclipse 4.4 以降で必須で、これを指定しないと
     起動できなかったり、一部の機能が正常に動作しない可能性があります。
     Windows 以外の場合は後述の Eclipse 起動オプション参照してください。

     -Xverify:none
     -javaagent:plugins/jp.sourceforge.mergedoc.pleiades/pleiades.jar

  3. Pleiades スプラッシュ画像を使う場合は
     eclipse.ini の -showsplash org.eclipse.platform (実際は 2 行) を削除。


 ┌ 注意 ---------------------------------------------------------------------------------------------
 │ Pleiades を更新したり、他のプラグインを追加・更新した場合は必ず起動オプションに -clean を指定
 │ して起動してください。Windows の場合は同梱している "eclipse.exe -clean.cmd" で -clean 起動でき
 │ ます。-clean 起動しないと、<Pleiades キャッシュ・ディレクトリ> の古いプラグイン情報が使用され、
 │ 起動できなくなったり更新したプラグインが正常に動作しなくなったりします。
 └---------------------------------------------------------------------------------------------------

  初回起動時は自動的に -clean モードで起動します。-clean での起動は、現在の環境に合わせて次回以降の
  実行速度を Pleiades が最適化しますが、通常よりかなり遅くなるため、-clean の常用は避けてください。
  -clean 起動の後、5～6 回 通常起動すると、不要な辞書をロードしなくなるため軽くなります。

  Windows の場合、デフォルトのフォントが Courier New 10 ポイントになっていますが ＭＳ ゴシック
  9 ポイントをオススメします。下記から設定できます。メニューから
  [ウィンドウ] - [設定] を開き、[一般] - [外観] - [色とフォント] の [基本] - [テキスト・フォント]
  で設定してください。



Eclipse からアンインストール (英語に戻す)
──────────────────────────────────────────────────

  Pleiades を無効にしたい場合は eclipse.ini 内の以下の 2 行の先頭に # を付けてコメントアウトするか
  行を削除してください。

     -Xverify:none
     -javaagent:〜/pleiades.jar

  完全にアンインストールする場合は、上記 2 行削除に加え、以下のディレクトリを削除してください。
  (All in One の場合、plugins と features は dropins/MergeDoc/ にあります)

    plugins/jp.sourceforge.mergedoc.pleiades/
    features/jp.sourceforge.mergedoc.pleiades/
    <Pleiades キャッシュ・ディレクトリ>

  <Pleiades キャッシュ・ディレクトリ> には Pleiades の構成やログが出力されます。Windows の場合、
  デフォルトでは <ECLIPSE_HOME>/configuration/jp.sourceforge.mergedoc.pleiades です。
  書き込み権限が無い場合は下記が使用されます。

    <ユーザーホーム>/.pleiades/<インストールパスのハイフン区切り>/

  ただし、Eclipse の config.ini に osgi.configuration.area が指定されている場合は、それが優先されます。
  IDEA で plugins ディレクトリに書き込み権がある場合は、以下が <Pleiades キャッシュ・ディレクトリ> になります。

    plugins/jp.sourceforge.mergedoc.pleiades/cache



FAQ
──────────────────────────────────────────────────

  Q. 起動しない / 動作が変 / 強制終了させたらおかしくなった(※)

	1. eclipse.ini に -Xverify:none を追加し忘れていないか確認してください。
	2. Eclipse 起動オプション -clean を指定して起動してみてください。
	3. <Pleiades キャッシュ・ディレクトリ> を削除して起動してみてください。
	4. コマンドラインから起動し、出力されるエラーを確認してください。Windows の場合は eclipse.exe
	   ではなく eclipsec.exe を使用してください。<Pleiades キャッシュ・ディレクトリ>/pleiades.log、
	   <ワークスペース>/.metadata/.log も確認してみてください。

	※強制終了させた場合は、必ず -clean 起動してください。初回起動や -clean での起動はマシンによって
	  は数分かかる場合があります。


  Q. なんかあんまり日本語化されない / ところどころ英語になってしまった

	1. Eclipse 起動オプション -clean を指定して起動してみてください。
	2. <Pleiades キャッシュ・ディレクトリ> を削除して起動してみてください。


  Q. Pleiades を入れたら WTP のプロジェクト・エクスプローラーに動的 Web プロジェクトなどが表示されな
     くなってしまった

	ワーキング・セットの設定を開いてチェックを入れなおしてください。


  Q. 翻訳追加したい、コントリビュートして本体に組み込んでもらいたい

	後述の debug オプションで翻訳を追加してください。
	コントリビュートいただける場合はフォーラムにプロパティー形式の翻訳をご投稿ください。
	なお、翻訳は全体の整合性を考慮し、取り込み前に修正される可能性があります。



Eclipse 起動オプション
──────────────────────────────────────────────────

  Pleiades を有効にするには、Eclipse の起動オプションに、-javaagent を追加してください。pleiades.jar
  へのパス指定は、Windows、macOS、Linux いずれの場合も、カレント・ディレクトリーからの相対パス、
  または絶対パスを指定してください。


  ◆方法 1: eclipse.ini 最終行に以下の指定を追加

    * Windows での設定 (相対パスでの指定例)

      -Xverify:none
      -javaagent:plugins/jp.sourceforge.mergedoc.pleiades/pleiades.jar


    * macOS での設定 (絶対パスでの指定例)

      macOS では  eclipse.ini は /Applications/Eclipse.app/Contents/Eclipse/ にあります。
      また、後述の no.mnemonic オプションは自動的に有効になります。

      -Xverify:none
      -javaagent:/Applications/Eclipse.app/Contents/Eclipse/plugins/jp.sourceforge.mergedoc.pleiades/pleiades.jar


  ◆方法 2: 起動引数に直接 pleiades.jar を指定

    例）eclipse -vmargs -Xverify:none -javaagent:plugins/jp.sourceforge.mergedoc.pleiades/pleiades.jar -Xmx1g

    * 起動引数に -vmargs を指定している場合は eclipse.ini の -vmargs は無効になるため、ヒープサイズ
      も指定してください。



Pleiades 起動オプション
──────────────────────────────────────────────────

  Pleiades のオプションは -javaagent 指定の末尾に指定します。複数のオプションを
  指定する場合はカンマで区切ってください。

    例）-javaagent:plugins/jp.sourceforge.mergedoc.pleiades/pleiades.jar=option,,,
                                                                        ~~~~~~~~~~

  default.splash

    Pleiades はスプラッシュ画像を変更します。Eclipse デフォルトのスプラッシュ画像を使用したい場合は
    このオプションを指定してください。

    Eclipse 3.3 以降、eclipse.ini にデフォルトで -showsplash org.eclipse.platform が指定されています
    が、この -showsplash は見かけ上の速度を上げるため、VM 起動前にスプラッシュを表示する Eclipse
    起動オプションです。つまり、Pleiades を使用しない場合、-showsplash を指定有無に関わらず、表示
    されるスプラッシュは同じです。Pleiades 側では VM 起動前の処理を制御できないため、default.splash
    オプションは Eclipse 起動オプションの -showsplash が未指定の場合のみ有効です。


  init.batch

    Windows 専用のオプションで初回起動時のみ実行するバッチファイルを相対パスまたはフルパスで指定します。
    初回起動時に <Pleiades キャッシュ・ディレクトリ>/.init.batch.processed が作成され、
    存在する場合は実行されません。このオプションは今のところ、Windows のみで有効です。
    例えば、Pleiades All in One の PHP 版では以下のオプションが指定されています。

    init.batch=../xampp/setup_xampp_no_pause.bat


  no.mnemonic

    メニューの "ファイル(F)" 末尾の (F) のようなニーモニックを表示しないようにします。macOS では
    自動的にこのオプションが有効になります。


  no.clean.message

	-clean 起動時のスプラッシュ下側のクリーン・メッセージを非表示にします。
	起動時に環境により AWT に関する EXCEPTION_ACCESS_VIOLATION などのエラーが発生する場合に指定してください。
	macOS では、起動時にデッドロックが発生する可能性があるため、この指定に関わらず常に非表示です。
	関連情報： https://github.com/cypher256/pleiades.io/issues/36


  debug

    訳が見つからなかった場合に、ログを UTF-8 のプロパティー形式で
    <Pleiades キャッシュ・ディレクトリ> の translation-notfound.properties に出力します。
    ただし、キャッシュされているものは出力されないため、Eclipse の場合は -clean で起動、
    IDEA 系の場合は <Pleiades キャッシュ・ディレクトリ> を手動で削除して再起動してください。

    このプロパティーから訳したい行をコピーし、Pleiades の /conf/additions ディレクトリーに適当なファ
    イル名でプロパティー・ファイル (.properties) を作成することで、オリジナルの訳を追加することがで
    きます。UTF-8 で保存してください。native2ascii は不要です。

	pleiades.log へ出力される実行ログは debug レベルで出力されます。



PDE での利用
──────────────────────────────────────────────────

  PDE などから Eclipse アプリケーションを起動して Pleiades を有効にするには
  一旦起動して起動構成を作成後、起動構成ダイアログの [引数]タブ - [VM 引数] に
  以下を指定してください。

    -javaagent:plugins/jp.sourceforge.mergedoc.pleiades/pleiades.jar



Pleiades を Eclipse プロジェクトとして zip からインポート
──────────────────────────────────────────────────

  [ファイル] - [インポート] - [既存プロジェクトをワークスペースに] で[アーカイブ・ファイルの選択] を
  チェックし pleiades_x.x.x-src.zip を選択してインポートしてください。



Pleiades を Eclipse プロジェクトとして SVN からチェックアウト
──────────────────────────────────────────────────

  http://osdn.jp/projects/mergedoc/wiki/Pleiades%E3%82%92Eclipse%E3%83%97%E3%83%AD%E3%82%B8%E3%82%A7%E3%82%AF%E3%83%88%E3%81%A8%E3%81%97%E3%81%A6%E3%83%81%E3%82%A7%E3%83%83%E3%82%AF%E3%82%A2%E3%82%A6%E3%83%88%E3%81%99%E3%82%8B



ライセンス
──────────────────────────────────────────────────

  Copyright (c) 2005- Shinji Kashihara. All rights reserved.

  orgThis program and the accompanying materials are
  made available under the terms of the Eclipse Public License v1.0 which
  accompanies this distribution, and is available at epl-v10.html.

  This product includes software developed by
  The Apache Software Foundation (http://www.apache.org/) and
  Shigeru Chiba, Tokyo Institute of Technology
  (http://www.csg.is.titech.ac.jp/~chiba/javassist/).

  Please read the different license files present in the /lib directory of
  this distribution.



Pleiades の辞書について
──────────────────────────────────────────────────

Pleiades の辞書には eclipse.org によって配布されてきた下記の言語パックの訳が含まれています。なお、
これらの訳は Pleiades により修正されている部分があります。

- birt-1.0.1
- birt-2.1.1
- cdt.sdk-2.0.2
- cdt.sdk-3.1.1
- dtp-sdk_0.9.1
- emf-sdo-SDK-2.1.1
- emf-sdo-SDK-2.2.1
- GEF-ALL-3.1.1
- GEF-ALL-3.2
- GMF-sdk-1.0.1
- tptp.sdk-TPTP-3.3.0
- tptp.sdk-TPTP-4.0.1
- tptp.sdk-TPTP-4.2.0
- uml2-SDK-1.1.1
- uml2-SDK-2.0.1
- VE-SDK-1.1.0.1
- VE-SDK-1.2.1
- wtp-sdk-0.7.1
- wtp-sdk-1.5.0
- wtp-sdk-1.5.1
- eclipse-SDK-2.1.2.1
- eclipse-SDK-3.0.1
- eclipse-SDK-3.1.1a
- eclipse-SDK-3.2.0
- eclipse-SDK-3.2.1

また、これらの言語パックは以下の Copyright（有効年範囲省略）が含まれています。

# Copyright (c) Actuate Corporation.
# Copyright (c) IBM Corporation and others.
# Copyright (c) Intel Corporation and others.
# Copyright (c) Nokia and others.
# Copyright (c) QNX Software Systems and others.
# Copyright (c) Rational Software Corporation and others.
# Copyright (c) Scapa Technologies Limited and others
# Copyright (c) Texas Instruments Inc. and others.



謝辞
──────────────────────────────────────────────────

  プロジェクト・メンバー

    Shinji Kashihara、いがぴょん (IGA Tosiki)、ymoto、Hideki Yamane (Debian JP)

  次の方々に翻訳提供や協力をいただきました。感謝いたします。(敬称略、順不同)

    かぬ、kutakuta、orihalcon、ちんちろりん、You＆I、asachin、遊、manila、Holy、yuizumi、yamamoto、
    いずも、samu、a man、muimy、yuki358、Pepe、same、yujirockets、inaba、shuji_w6e、MON-80、yoshisan、
    takekazuomi、skimura、nishi、ryo terai、Masaru Horioka、megos

    CodeGear from Borland、エンバカデロ・テクノロジーズ (CodeGear)、NTT データビジネスブレインズ、
    キヤノンソフトウェア株式会社

    (c) 19-10 - Eclipse 3.5～3.8 以降スプラッシュ画像



変更履歴
──────────────────────────────────────────────────

readme_pleiades_changes.txt 参照。
