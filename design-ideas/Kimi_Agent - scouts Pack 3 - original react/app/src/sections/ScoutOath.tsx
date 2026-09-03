import { motion } from 'framer-motion';
import { ScrollReveal, StaggerContainer, StaggerItem } from '@/components/ScrollReveal';
import { Scroll, BookOpen, Flag } from 'lucide-react';

const scoutValues = [
  {
    icon: Scroll,
    title: 'The Scout Oath',
    content: 'On my honor I will do my best to do my duty to God and my country and to obey the Scout Law; to help other people at all times; to keep myself physically strong, mentally awake, and morally straight.',
    color: 'bg-scout-green',
  },
  {
    icon: BookOpen,
    title: 'The Scout Law',
    content: 'A Scout is trustworthy, loyal, helpful, friendly, courteous, kind, obedient, cheerful, thrifty, brave, clean, and reverent.',
    color: 'bg-scout-orange',
  },
  {
    icon: Flag,
    title: 'The Scout Mission',
    content: 'The mission of Scouting America is to prepare young people to make ethical and moral choices over their lifetimes by instilling in them the values of the Scout Oath and Scout Law.',
    color: 'bg-blue-600',
  },
];

export function ScoutOath() {
  return (
    <section id="faqs" className="py-20 bg-scout-green relative overflow-hidden">
      {/* Background Pattern */}
      <div className="absolute inset-0 opacity-5">
        <div className="absolute top-10 left-10 w-40 h-40 border-4 border-white rounded-full" />
        <div className="absolute bottom-20 right-20 w-60 h-60 border-4 border-white rounded-full" />
        <div className="absolute top-1/2 left-1/4 w-20 h-20 border-4 border-white rotate-45" />
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {/* Header */}
        <div className="text-center mb-16">
          <ScrollReveal>
            <span className="inline-block text-scout-yellow font-semibold text-sm uppercase tracking-wide mb-4">
              Our Foundation
            </span>
          </ScrollReveal>
          
          <ScrollReveal delay={0.1}>
            <h2 className="font-heading text-4xl sm:text-5xl font-bold text-white mb-4">
              The Values We Live By
            </h2>
          </ScrollReveal>
          
          <ScrollReveal delay={0.2}>
            <p className="text-lg text-white/80 max-w-2xl mx-auto">
              Scouting is built on timeless principles that guide our scouts 
              to become responsible, ethical citizens.
            </p>
          </ScrollReveal>
        </div>

        {/* Cards Grid */}
        <StaggerContainer className="grid md:grid-cols-3 gap-8" staggerDelay={0.15}>
          {scoutValues.map((item, index) => (
            <StaggerItem key={item.title}>
              <motion.div
                whileHover={{ y: -8, scale: 1.02 }}
                transition={{ duration: 0.3 }}
                className="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 h-full"
              >
                {/* Icon */}
                <motion.div
                  animate={{ 
                    scale: [1, 1.1, 1],
                  }}
                  transition={{ 
                    duration: 2, 
                    repeat: Infinity, 
                    delay: index * 0.5 
                  }}
                  className={`w-16 h-16 ${item.color} rounded-xl flex items-center justify-center mb-6`}
                >
                  <item.icon className="w-8 h-8 text-white" />
                </motion.div>

                {/* Title */}
                <h3 className="font-heading font-bold text-2xl text-white mb-4">
                  {item.title}
                </h3>

                {/* Content */}
                <p className="text-white/90 leading-relaxed text-lg">
                  {item.content}
                </p>
              </motion.div>
            </StaggerItem>
          ))}
        </StaggerContainer>

        {/* Scout Law Points */}
        <ScrollReveal delay={0.6}>
          <div className="mt-16 bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
            <h3 className="font-heading font-bold text-xl text-white text-center mb-6">
              The Twelve Points of the Scout Law
            </h3>
            <div className="flex flex-wrap justify-center gap-3">
              {[
                'Trustworthy', 'Loyal', 'Helpful', 'Friendly', 
                'Courteous', 'Kind', 'Obedient', 'Cheerful',
                'Thrifty', 'Brave', 'Clean', 'Reverent'
              ].map((point, index) => (
                <motion.span
                  key={point}
                  initial={{ opacity: 0, scale: 0.8 }}
                  whileInView={{ opacity: 1, scale: 1 }}
                  viewport={{ once: true }}
                  transition={{ delay: 0.7 + index * 0.05 }}
                  whileHover={{ scale: 1.1, backgroundColor: '#FF6F00' }}
                  className="px-4 py-2 bg-white/10 text-white rounded-full text-sm font-medium cursor-default transition-colors"
                >
                  {point}
                </motion.span>
              ))}
            </div>
          </div>
        </ScrollReveal>
      </div>
    </section>
  );
}
