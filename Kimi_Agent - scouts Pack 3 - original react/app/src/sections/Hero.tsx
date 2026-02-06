import { motion } from 'framer-motion';
import { Button } from '@/components/ui/button';
import { MapPin, Calendar, Clock, ChevronRight } from 'lucide-react';

export function Hero() {
  return (
    <section id="home" className="relative min-h-screen flex items-center pt-[72px]">
      {/* Background Image */}
      <div 
        className="absolute inset-0 bg-cover bg-center bg-no-repeat"
        style={{ backgroundImage: 'url(/images/hero-bg.jpg)' }}
      >
        <div className="absolute inset-0 bg-gradient-to-r from-scout-green/90 via-scout-green/70 to-transparent" />
      </div>

      {/* Content */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          {/* Left Column - Text */}
          <div className="text-white">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6, delay: 0.2 }}
            >
              <span className="inline-block bg-scout-orange text-white px-4 py-1.5 rounded-full text-sm font-semibold mb-6">
                Registration Always Open
              </span>
            </motion.div>

            <motion.h1
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6, delay: 0.3 }}
              className="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-4"
            >
              Albany Cub Scouts Pack 3
            </motion.h1>

            <motion.p
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6, delay: 0.4 }}
              className="text-xl sm:text-2xl text-white/90 font-display mb-4"
            >
              Are you ready for more s'mores, skits, badges, and outdoor fun?
            </motion.p>

            <motion.p
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6, delay: 0.5 }}
              className="text-white/80 text-lg mb-8 max-w-lg"
            >
              Albany Pack 3 is back in action for 2025-2026! We're an inclusive 
              pack welcoming all kids in Kindergarten through Fifth Grade.
            </motion.p>

            {/* Next Meeting Card */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6, delay: 0.6 }}
              className="bg-white/10 backdrop-blur-sm rounded-xl p-6 mb-8 border border-white/20"
            >
              <h3 className="text-scout-orange font-semibold text-sm uppercase tracking-wide mb-3">
                Parent Info Event
              </h3>
              <div className="space-y-2">
                <div className="flex items-center gap-3">
                  <Calendar className="w-5 h-5 text-scout-orange" />
                  <span className="text-white">Thursday, August 21, 2025</span>
                </div>
                <div className="flex items-center gap-3">
                  <Clock className="w-5 h-5 text-scout-orange" />
                  <span className="text-white">6:30 PM - 7:30 PM</span>
                </div>
                <div className="flex items-center gap-3">
                  <MapPin className="w-5 h-5 text-scout-orange" />
                  <span className="text-white">Memorial Hall, Memorial Park</span>
                </div>
              </div>
            </motion.div>

            {/* CTA Buttons */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6, delay: 0.7 }}
              className="flex flex-wrap gap-4"
            >
              <Button 
                size="lg"
                className="bg-scout-orange hover:bg-scout-orange-dark text-white font-semibold px-8 py-6 text-lg transition-all hover:scale-105 animate-pulse-glow"
              >
                Join Pack 3
                <ChevronRight className="ml-2 w-5 h-5" />
              </Button>
              <Button 
                size="lg"
                variant="outline"
                className="border-2 border-white text-white hover:bg-white hover:text-scout-green font-semibold px-8 py-6 text-lg transition-all"
              >
                About Cub Scouts
              </Button>
            </motion.div>
          </div>

          {/* Right Column - Logo */}
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 0.8, delay: 0.4 }}
            className="hidden lg:flex justify-center"
          >
            <div className="relative">
              <motion.div
                animate={{ y: [0, -10, 0] }}
                transition={{ duration: 3, repeat: Infinity, ease: "easeInOut" }}
                className="w-80 h-80 flex items-center justify-center"
              >
                <img 
                  src="/images/pack3-logo.png" 
                  alt="Albany Cub Scouts Pack 3 Logo"
                  className="w-full h-full object-contain drop-shadow-2xl"
                />
              </motion.div>
              {/* Decorative elements */}
              <div className="absolute -top-4 -right-4 w-20 h-20 bg-scout-orange rounded-full opacity-80" />
              <div className="absolute -bottom-6 -left-6 w-16 h-16 bg-scout-yellow rounded-full opacity-60" />
            </div>
          </motion.div>
        </div>
      </div>

      {/* Scroll indicator */}
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ delay: 1.5 }}
        className="absolute bottom-8 left-1/2 -translate-x-1/2"
      >
        <motion.div
          animate={{ y: [0, 10, 0] }}
          transition={{ duration: 1.5, repeat: Infinity }}
          className="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center pt-2"
        >
          <div className="w-1.5 h-3 bg-white/70 rounded-full" />
        </motion.div>
      </motion.div>
    </section>
  );
}
