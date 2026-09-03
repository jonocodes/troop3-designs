module.exports = function (eleventyConfig) {
  // Static assets served at site root so design.css url('images/..') paths resolve
  eleventyConfig.addPassthroughCopy({ "src/design.css": "design.css" });
  eleventyConfig.addPassthroughCopy({ "src/images": "images" });
  eleventyConfig.addPassthroughCopy({ "src/admin": "admin" });

  return {
    dir: { input: "src", output: "_site", data: "_data" },
    htmlTemplateEngine: "njk",
    markdownTemplateEngine: "njk",
  };
};
