const electron = require('electron')
const app = electron.app
const BrowserWindow = electron.BrowserWindow
const path = require('path')
const url = require('url')

function createWindow () {
  let mainWindow = new BrowserWindow({width: 880, height: 630})
  mainWindow.loadURL(url.format({
    pathname: path.join(__dirname, 'index.html'),
    protocol: 'file:',
    slashes: true
  }))
  // mainWindow.webContents.openDevTools()
}

app.on('ready', createWindow)
app.on('window-all-closed', function () {
  app.quit()
})
