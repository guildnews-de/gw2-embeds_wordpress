// Requires
const fs = require("fs");
const rimraf = require("rimraf");
const dArch = require("dir-archiver");
const path = require("path");

const gw2Embeds = path.dirname(require.resolve("gw2-embeds"));
const gw2MapEmbeds = path.dirname(require.resolve("gw2-map-embeds"));
const packStats = require("./composer.json");
const dir = path.resolve("./dist");

function fsError(err) {
  if (err) {
    return console.error(err);
  }
}

// Prepare empty dist dir
rimraf.sync(dir);
fs.mkdirSync(dir, null, (err) => {
  fsError(err);
});
fs.mkdirSync(`${dir}/raw`, null, (err) => {
  fsError(err);
});

// Copy data
fs.cpSync("./src", `${dir}/raw/`, { recursive: true }, (err) => {
  fsError(err);
});
fs.cpSync(
  gw2Embeds,
  `${dir}/raw/public/gw2-embeds/`,
  { recursive: true },
  (err) => {
    fsError(err);
  }
);
fs.cpSync(
  gw2MapEmbeds,
  `${dir}/raw/public/gw2-map-embeds/`,
  { recursive: true },
  (err) => {
    fsError(err);
  }
);

// Build zip file
const archive = new dArch(
  `${dir}/raw`,
  `${dir}/gw2-embeds_wp_${packStats.version}.zip`,
  false,
  []
);

archive.createZip();
