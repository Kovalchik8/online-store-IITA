const path = require('path'),
  settings = require('./settings');

module.exports = {
  
  entry: {
    App: settings.themeLocation + "js/App.js"
  },
  output: {
    path: path.resolve(__dirname, settings.themeLocation + "js"),
    filename: "scripts-bundled.js"
  },
  mode: 'production',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['es2015'] 
          }
        }
      }
    ]
  },
 
}