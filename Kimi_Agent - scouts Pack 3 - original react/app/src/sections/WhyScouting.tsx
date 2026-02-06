import { motion } from 'framer-motion';
import { ScrollReveal, StaggerContainer, StaggerItem } from '@/components/ScrollReveal';
import { 
  Users, 
  Trees, 
  HeartHandshake, 
  Dumbbell, 
  Award, 
  Smile 
} from 'lucide-react';

const benefits = [
  {
    icon: Users,
    title: 'Leadership Development',
    description: 'Scouts share in adventure and take turns leading other scouts, building confidence and communication skills.',
    color: 'from-scout-green to-scout-green-light',
  },
  {
    icon: Trees,
    title: 'Outdoor Skills',
    description: 'Scouts learn how to safely enjoy and care for the outdoors through camping, hiking, and nature activities.',
    color: 'from-emerald-600 to-emerald-500',
  },
  {
    icon: HeartHandshake,
    title: 'Participatory Citizenship',
    description: 'Civic awareness and patriotism with an emphasis on service to the community through volunteer projects.',
    color: 'from-blue-600 to-blue-500',
  },
  {
    icon: Dumbbell,
    title: 'Personal Fitness',
    description: 'Healthy eating and an active lifestyle are encouraged through physical activities and sports.',
    color: 'from-orange-600 to-orange-500',
  },
  {
    icon: Award,
    title: 'Character Building',
    description: 'We seek to develop good character, guided by the Scout Oath, Scout Law, and Scout Mission.',
    color: 'from-purple-600 to-purple-500',
  },
  {
    icon: Smile,
    title: 'Lifelong Friendship',
    description: 'Make lifelong friends and create memories that will last a lifetime through shared experiences.',
    color: 'from-pink-600 to-pink-500',
  },
];

export function WhyScouting() {
  return (
    <section className="py-20 bg-background">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-16">
          <ScrollReveal>
            <span className="inline-block text-scout-orange font-semibold text-sm uppercase tracking-wide mb-4">
              Building Skills for Life
            </span>
          </ScrollReveal>
          
          <ScrollReveal delay={0.1}>
            <h2 className="font-heading text-4xl sm:text-5xl font-bold text-foreground mb-4">
              Why Scouting <span className="text-scout-green">Matters</span>
            </h2>
          </ScrollReveal>
          
          <ScrollReveal delay={0.2}>
            <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
              Cub Scouting is focused on fun and friendship, and along the way 
              we nurture personal growth and social skills.
            </p>
          </ScrollReveal>
        </div>

        {/* Benefits Grid */}
        <StaggerContainer className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" staggerDelay={0.08}>
          {benefits.map((benefit) => (
            <StaggerItem key={benefit.title}>
              <motion.div
                whileHover={{ y: -6, scale: 1.02 }}
                transition={{ duration: 0.3 }}
                className="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 h-full"
              >
                {/* Icon */}
                <motion.div
                  whileHover={{ rotate: [0, -10, 10, 0] }}
                  transition={{ duration: 0.5 }}
                  className={`w-14 h-14 rounded-xl bg-gradient-to-br ${benefit.color} flex items-center justify-center mb-5`}
                >
                  <benefit.icon className="w-7 h-7 text-white" />
                </motion.div>

                {/* Title */}
                <h3 className="font-heading font-bold text-xl text-foreground mb-3 group-hover:text-scout-green transition-colors">
                  {benefit.title}
                </h3>

                {/* Description */}
                <p className="text-muted-foreground leading-relaxed">
                  {benefit.description}
                </p>
              </motion.div>
            </StaggerItem>
          ))}
        </StaggerContainer>

        {/* Stats Section */}
        <ScrollReveal delay={0.6}>
          <div className="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
            {[
              { value: '100+', label: 'Years of Scouting' },
              { value: '2M+', label: 'Scouts Nationwide' },
              { value: '130+', label: 'Merit Badges' },
              { value: '50+', label: 'Pack 3 Alumni' },
            ].map((stat, idx) => (
              <motion.div
                key={stat.label}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: 0.7 + idx * 0.1 }}
                className="text-center"
              >
                <div className="font-heading font-bold text-4xl sm:text-5xl text-scout-green mb-2">
                  {stat.value}
                </div>
                <div className="text-muted-foreground text-sm">{stat.label}</div>
              </motion.div>
            ))}
          </div>
        </ScrollReveal>
      </div>
    </section>
  );
}
