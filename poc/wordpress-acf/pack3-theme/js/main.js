/**
 * Pack 3 Theme - Main JavaScript
 * Handles: mobile menu, FAQ accordion, back-to-top button.
 */

/* Mobile Menu Toggle */
function pack3ToggleMenu() {
    document.querySelector('.mobile-menu').classList.toggle('active');
    document.querySelector('.overlay').classList.toggle('active');
}

/* FAQ Accordion */
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.faq-question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = this.parentElement;
            var wasActive = item.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(function (i) {
                i.classList.remove('active');
            });
            if (!wasActive) {
                item.classList.add('active');
            }
        });
    });
});

/* Back to Top Button */
window.addEventListener('scroll', function () {
    var btn = document.querySelector('.back-to-top');
    if (btn) {
        if (window.scrollY > 500) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    }
});
