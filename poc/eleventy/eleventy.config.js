module.exports = function (eleventyConfig) {
  eleventyConfig.addPassthroughCopy({ "src/styles.css": "styles.css" });
  eleventyConfig.addPassthroughCopy({ "src/images": "images" });
  eleventyConfig.addPassthroughCopy({ "src/site.js": "site.js" });

  return {
    dir: { input: "src", output: "_site" },
    htmlTemplateEngine: "njk",
  };
};
