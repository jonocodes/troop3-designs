import { motion } from 'framer-motion';
import { ScrollReveal } from '@/components/ScrollReveal';
import { Heart, Target, Shield, Star } from 'lucide-react';

const values = [
  {
    icon: Heart,
    title: 'Character',
    description: 'Building strong moral character',
  },
  {
    icon: Target,
    title: 'Citizenship',
    description: 'Being responsible community members',
  },
  {
    icon: Shield,
    title: 'Fitness',
    description: 'Promoting healthy active lifestyles',
  },
  {
    icon: Star,
    title: 'Leadership',
    description: 'Developing future leaders',
  },
];

export function Welcome() {
  return (
    <section id="about" className="py-20 bg-background">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          {/* Left Column - Text */}
          <div>
            <ScrollReveal>
              <span className="inline-block text-scout-orange font-semibold text-sm uppercase tracking-wide mb-4">
                Welcome to Albany Cub Scouts Pack 3
              </span>
            </ScrollReveal>
            
            <ScrollReveal delay={0.1}>
              <h2 className="font-heading text-4xl sm:text-5xl font-bold text-foreground mb-6">
                Are you ready for more <span className="text-scout-green">s'mores, skits, badges, and outdoor fun?</span>
              </h2>
            </ScrollReveal>
            
            <ScrollReveal delay={0.2}>
              <p className="text-lg text-muted-foreground leading-relaxed mb-6">
                Albany Cub Scouts are kids in kindergarten through fifth grade who join a pack 
                to go hiking, play games, learn skills, make friends, and much, much more.
              </p>
            </ScrollReveal>
            
            <ScrollReveal delay={0.3}>
              <p className="text-lg text-muted-foreground leading-relaxed mb-6">
                <strong>Cub Scouting means "doing".</strong> You have lots to do as a Cub Scout—hiking, 
                camping, crafts, games, sports, songs, stories, and puzzles, to name just a few things. 
                Much of the fun happens right in the den and pack.
              </p>
            </ScrollReveal>

            <ScrollReveal delay={0.4}>
              <p className="text-lg text-muted-foreground leading-relaxed mb-8">
                Scouts also participate in events like the annual Blue and Gold banquet, the Pinewood Derby, 
                an Egg Drop, and our Pancake Breakfast. They go on field trips, camping, and have other 
                kinds of outdoor adventures. Whatever it is that you enjoy, you'll have a chance to do it 
                in Cub Scouting!
              </p>
            </ScrollReveal>

            {/* Highlight Box */}
            <ScrollReveal delay={0.5}>
              <div className="bg-scout-green/5 border-l-4 border-scout-orange p-6 rounded-r-lg mb-8">
                <p className="text-scout-green font-heading font-bold text-lg">
                  "Albany Pack 3 has a long and proud history of service to Albany's youth and to the community as a whole."
                </p>
              </div>
            </ScrollReveal>

            {/* Values Grid */}
            <ScrollReveal delay={0.6}>
              <div className="grid grid-cols-2 gap-4">
                {values.map((value, index) => (
                  <motion.div
                    key={value.title}
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ delay: 0.7 + index * 0.1 }}
                    className="flex items-start gap-3"
                  >
                    <div className="w-10 h-10 bg-scout-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                      <value.icon className="w-5 h-5 text-scout-green" />
                    </div>
                    <div>
                      <h4 className="font-heading font-semibold text-foreground">{value.title}</h4>
                      <p className="text-sm text-muted-foreground">{value.description}</p>
                    </div>
                  </motion.div>
                ))}
              </div>
            </ScrollReveal>
          </div>

          {/* Right Column - Image */}
          <ScrollReveal direction="right" delay={0.3}>
            <div className="relative">
              <div className="relative rounded-2xl overflow-hidden shadow-card">
                <img 
                  src="/images/welcome-group.jpg" 
                  alt="Pack 3 families at community event"
                  className="w-full h-auto object-cover"
                />
              </div>
              
              {/* Floating Stats Card */}
              <motion.div
                initial={{ opacity: 0, scale: 0.8 }}
                whileInView={{ opacity: 1, scale: 1 }}
                viewport={{ once: true }}
                transition={{ delay: 0.8 }}
                className="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-card-hover p-6"
              >
                <div className="flex items-center gap-4">
                  <div className="w-14 h-14 bg-scout-orange/10 rounded-full flex items-center justify-center">
                    <span className="text-scout-orange font-heading font-bold text-2xl">K-5</span>
                  </div>
                  <div>
                    <p className="font-heading font-bold text-foreground">All Welcome</p>
                    <p className="text-sm text-muted-foreground">Kindergarten to 5th Grade</p>
                  </div>
                </div>
              </motion.div>

              {/* Inclusive Badge */}
              <motion.div
                initial={{ opacity: 0, scale: 0.8 }}
                whileInView={{ opacity: 1, scale: 1 }}
                viewport={{ once: true }}
                transition={{ delay: 1 }}
                className="absolute -top-4 -right-4 bg-white rounded-xl shadow-card-hover p-4"
              >
                <div className="flex items-center gap-2">
                  <div className="w-10 h-10 bg-scout-green rounded-full flex items-center justify-center">
                    <Heart className="w-5 h-5 text-white" />
                  </div>
                  <div>
                    <p className="font-heading font-bold text-sm text-foreground">Inclusive Unit</p>
                    <p className="text-xs text-muted-foreground">Scouts for Equality</p>
                  </div>
                </div>
              </motion.div>

              {/* Decorative elements */}
              <div className="absolute -top-4 -right-4 w-24 h-24 bg-scout-yellow/20 rounded-full -z-10" />
              <div className="absolute -bottom-8 right-12 w-16 h-16 bg-scout-green/20 rounded-full -z-10" />
            </div>
          </ScrollReveal>
        </div>
      </div>
    </section>
  );
}
