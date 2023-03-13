// postcss.config.js

module.exports = {
    plugins: [
        require("autoprefixer")({
            overrideBrowserslist: ["last 2 versions", "ie >= 11"],
            grid: true
        }),
    ]
}

