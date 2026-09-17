module.exports = function (eleventyConfig) {
  // Design assets stay the single source of truth in raw-html/ (no duplication).
  eleventyConfig.addPassthroughCopy({ "../../raw-html/images": "images" });
  eleventyConfig.addPassthroughCopy({ "../../raw-html/styles.css": "styles.css" });
  eleventyConfig.addPassthroughCopy({ "src/site.js": "site.js" });

  return {
    dir: { input: "src", output: "_site" },
    htmlTemplateEngine: "njk",
  };
};
