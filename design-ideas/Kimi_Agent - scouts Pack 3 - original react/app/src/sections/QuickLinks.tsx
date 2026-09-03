import { motion } from 'framer-motion';
import { ArrowRight, Users, ClipboardList, Tent, HelpCircle } from 'lucide-react';

const quickLinks = [
  {
    title: 'OUR TEAM',
    description: 'Meet the Pack 3 leadership team.',
    image: '/images/card-team.jpg',
    href: '#about',
    color: 'from-scout-green/80 to-scout-green/60',
    icon: Users,
  },
  {
    title: 'REGISTRATION',
    description: 'Learn about membership and fees.',
    image: '/images/card-registration.jpg',
    href: '#register',
    color: 'from-scout-orange/80 to-scout-orange/60',
    icon: ClipboardList,
  },
  {
    title: 'ACTIVITIES',
    description: 'Explore our events and adventures.',
    image: '/images/card-activities.jpg',
    href: '#activities',
    color: 'from-blue-600/80 to-blue-500/60',
    icon: Tent,
  },
  {
    title: 'SCOUTING FAQs',
    description: 'Common questions answered.',
    image: '/images/card-faqs.jpg',
    href: '#faqs',
    color: 'from-amber-600/80 to-amber-500/60',
    icon: HelpCircle,
  },
];

export function QuickLinks() {
  return (
    <section className="py-0">
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        {quickLinks.map((link, index) => (
          <motion.a
            key={link.title}
            href={link.href}
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6, delay: index * 0.1 }}
            className="group relative h-[320px] overflow-hidden"
          >
            {/* Background Image */}
            <div 
              className="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
              style={{ backgroundImage: `url(${link.image})` }}
            />
            
            {/* Gradient Overlay */}
            <div className={`absolute inset-0 bg-gradient-to-t ${link.color} transition-opacity duration-300`} />
            
            {/* Content */}
            <div className="relative z-10 h-full flex flex-col justify-end p-6 text-white">
              <link.icon className="w-8 h-8 mb-3 text-white/90" />
              <h3 className="font-heading font-bold text-xl mb-2">{link.title}</h3>
              <p className="text-white/80 text-sm mb-4">{link.description}</p>
              <div className="flex items-center text-sm font-semibold">
                <span>Learn More</span>
                <ArrowRight className="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-2" />
              </div>
            </div>

            {/* Hover overlay */}
            <div className="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
          </motion.a>
        ))}
      </div>
    </section>
  );
}
