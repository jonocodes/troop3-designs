# Pack 3 site — common tasks. Run `just` for the list.

set shell := ["bash", "-uc"]

# Pre-optimisation image commit. `just originals` extracts from here.
orig_ref := "13c27e7"

# mozjpeg must be listed BEFORE imagemagick, otherwise imagemagick's transitive
# libjpeg-turbo shadows cjpeg and the script quietly produces larger files.
img_tools := "mozjpeg imagemagick pngquant"

default:
    @just --list

# Extract the pre-optimisation image originals from git into more-images/originals/
# ({{orig_ref}} predates the raw-html -> site rename, so its archived path is still raw-html/images)
originals:
    @mkdir -p more-images/originals
    @git archive {{orig_ref}} raw-html/images | tar -x -C more-images/originals
    @echo "originals extracted from {{orig_ref}} -> more-images/originals/raw-html/images"

# Optimise site/images in place (resize + mozjpeg/pngquant). See docs/IMAGE-OPTIMIZATION.md.
images:
    @nix-shell -p {{img_tools}} --run 'scripts/optimize-images.sh'

# Total size of the images referenced by the live page
size:
    @node -e 'const fs=require("fs");const seen=new Set();for(const src of ["site/index.html","site/styles.css"])for(const m of fs.readFileSync(src,"utf8").matchAll(/images\/[A-Za-z0-9._-]+/g))seen.add(m[0].replace("images/",""));let t=0;for(const f of seen)t+=fs.statSync("site/images/"+f).size;console.log(seen.size+" images, "+(t/1024/1024).toFixed(2)+" MB referenced by the live page")'

# Serve the site locally
serve:
    @npx serve site

# Regenerate images from originals and report the referenced total
optimize: images size
