import { motion } from 'framer-motion';
import { 
  Mail, 
  MapPin, 
  Instagram, 
  Facebook, 
  Twitter,
  ExternalLink,
  ChevronUp,
  Heart
} from 'lucide-react';

const quickLinks = [
  { name: 'Home', href: '#home' },
  { name: 'About', href: '#about' },
  { name: 'Activities', href: '#activities' },
  { name: 'FAQs', href: '#faqs' },
  { name: 'Contact', href: '#contact' },
  { name: 'Join Pack 3', href: '#join' },
];

const resources = [
  { name: 'Scouting America', href: 'https://www.scouting.org' },
  { name: 'Youth Protection Training', href: 'https://www.scouting.org/training/youth-protection/' },
  { name: 'Golden Gate Council', href: '#' },
  { name: 'Pack Calendar', href: '#' },
];

export function Footer() {
  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <footer id="contact" className="bg-scout-green-dark text-white">
      {/* Main Footer */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-12">
          {/* Logo & About */}
          <div className="lg:col-span-1">
            <div className="flex items-center gap-3 mb-6">
              <div className="w-14 h-14 bg-white rounded-lg flex items-center justify-center overflow-hidden">
                <img 
                  src="/images/pack3-logo.png" 
                  alt="Pack 3 Logo"
                  className="w-12 h-12 object-contain"
                />
              </div>
              <div>
                <h3 className="font-heading font-bold text-lg">Pack 3</h3>
                <p className="text-white/60 text-sm">Albany, CA</p>
              </div>
            </div>
            <p className="text-white/70 text-sm leading-relaxed mb-6">
              Building character, citizenship, and personal fitness in young people 
              through fun outdoor adventures and community service since 1935.
            </p>
            
            {/* Social Links */}
            <div className="flex gap-3">
              {[
                { icon: Instagram, href: '#', label: 'Instagram' },
                { icon: Facebook, href: '#', label: 'Facebook' },
                { icon: Twitter, href: '#', label: 'Twitter' },
              ].map((social) => (
                <motion.a
                  key={social.label}
                  href={social.href}
                  whileHover={{ scale: 1.1 }}
                  whileTap={{ scale: 0.95 }}
                  className="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-scout-orange transition-colors"
                  aria-label={social.label}
                >
                  <social.icon className="w-5 h-5" />
                </motion.a>
              ))}
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="font-heading font-bold text-lg mb-6">Quick Links</h4>
            <ul className="space-y-3">
              {quickLinks.map((link) => (
                <li key={link.name}>
                  <a 
                    href={link.href}
                    className="text-white/70 hover:text-scout-orange transition-colors text-sm inline-flex items-center group"
                  >
                    <span className="w-0 group-hover:w-2 h-0.5 bg-scout-orange mr-0 group-hover:mr-2 transition-all" />
                    {link.name}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Resources */}
          <div>
            <h4 className="font-heading font-bold text-lg mb-6">Resources</h4>
            <ul className="space-y-3">
              {resources.map((link) => (
                <li key={link.name}>
                  <a 
                    href={link.href}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="text-white/70 hover:text-scout-orange transition-colors text-sm inline-flex items-center group"
                  >
                    {link.name}
                    <ExternalLink className="w-3 h-3 ml-1 opacity-0 group-hover:opacity-100 transition-opacity" />
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h4 className="font-heading font-bold text-lg mb-6">Contact Us</h4>
            <ul className="space-y-4">
              <li>
                <a 
                  href="mailto:cubmaster@albanycubscouts.org"
                  className="text-white/70 hover:text-scout-orange transition-colors text-sm flex items-start gap-3"
                >
                  <Mail className="w-5 h-5 text-scout-orange flex-shrink-0 mt-0.5" />
                  <span>cubmaster@albanycubscouts.org</span>
                </a>
              </li>
              <li className="flex items-start gap-3">
                <MapPin className="w-5 h-5 text-scout-orange flex-shrink-0 mt-0.5" />
                <span className="text-white/70 text-sm">
                  Veterans Memorial Hall<br />
                  1325 Portland Avenue<br />
                  Albany, CA 94706
                </span>
              </li>
            </ul>

            {/* Meeting Info */}
            <div className="mt-6 p-4 bg-white/5 rounded-lg">
              <p className="text-white/90 text-sm font-semibold mb-1">Pack Meetings</p>
              <p className="text-white/60 text-sm">First Thursday of each month</p>
              <p className="text-white/60 text-sm">6:30 PM - 7:30 PM</p>
            </div>
          </div>
        </div>
      </div>

      {/* Bottom Bar */}
      <div className="border-t border-white/10">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
          <div className="flex flex-col sm:flex-row justify-between items-center gap-4">
            <p className="text-white/50 text-sm text-center sm:text-left">
              © {new Date().getFullYear()} Albany Cub Scout Pack 3. All rights reserved.
            </p>
            <p className="text-white/50 text-sm flex items-center gap-1">
              Made with <Heart className="w-4 h-4 text-scout-orange fill-scout-orange" /> in Albany, CA
            </p>
          </div>
        </div>
      </div>

      {/* Back to Top Button */}
      <motion.button
        onClick={scrollToTop}
        initial={{ opacity: 0 }}
        whileInView={{ opacity: 1 }}
        viewport={{ once: false }}
        whileHover={{ scale: 1.1 }}
        whileTap={{ scale: 0.95 }}
        className="fixed bottom-8 right-8 w-12 h-12 bg-scout-orange hover:bg-scout-orange-dark text-white rounded-full shadow-lg flex items-center justify-center transition-colors z-40"
        aria-label="Back to top"
      >
        <ChevronUp className="w-6 h-6" />
      </motion.button>
    </footer>
  );
}
