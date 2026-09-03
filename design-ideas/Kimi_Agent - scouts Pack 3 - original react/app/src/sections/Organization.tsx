import { motion } from 'framer-motion';
import { ScrollReveal, StaggerContainer, StaggerItem } from '@/components/ScrollReveal';
import { 
  Baby, 
  Cat, 
  Dog, 
  PawPrint,
  Feather,
  Award,
  Users,
  MapPin,
  Calendar
} from 'lucide-react';

const dens = [
  {
    rank: 'Lion',
    grade: 'Kindergarten',
    description: 'Our youngest scouts start their adventure!',
    icon: Baby,
    color: 'from-yellow-400 to-yellow-500',
  },
  {
    rank: 'Tiger',
    grade: '1st Grade',
    description: 'Building confidence and new skills.',
    icon: Cat,
    color: 'from-orange-400 to-orange-500',
  },
  {
    rank: 'Wolf',
    grade: '2nd Grade',
    description: 'Exploring the outdoors and community.',
    icon: Dog,
    color: 'from-blue-400 to-blue-500',
  },
  {
    rank: 'Bear',
    grade: '3rd Grade',
    description: 'Taking on bigger challenges together.',
    icon: PawPrint,
    color: 'from-purple-400 to-purple-500',
  },
  {
    rank: 'Webelos',
    grade: '4th Grade',
    description: 'We Be Loyal Scouts - preparing for the next step.',
    icon: Feather,
    color: 'from-red-400 to-red-500',
  },
  {
    rank: 'Arrow of Light',
    grade: '5th Grade',
    description: 'The highest rank in Cub Scouting before bridging to Scouts.',
    icon: Award,
    color: 'from-scout-green to-scout-green-light',
  },
];

export function Organization() {
  return (
    <section className="py-20 bg-muted/30">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-16">
          <ScrollReveal>
            <span className="inline-block text-scout-orange font-semibold text-sm uppercase tracking-wide mb-4">
              How We're Organized
            </span>
          </ScrollReveal>
          
          <ScrollReveal delay={0.1}>
            <h2 className="font-heading text-4xl sm:text-5xl font-bold text-foreground mb-4">
              Pack <span className="text-scout-green">Organization</span>
            </h2>
          </ScrollReveal>
          
          <ScrollReveal delay={0.2}>
            <p className="text-lg text-muted-foreground max-w-3xl mx-auto">
              Albany Cub Scouts Pack 3 is made up of dens organized by age group. 
              Different grade levels work toward achieving the rank for that year.
            </p>
          </ScrollReveal>
        </div>

        {/* Dens Grid */}
        <StaggerContainer className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" staggerDelay={0.1}>
          {dens.map((den) => (
            <StaggerItem key={den.rank}>
              <motion.div
                whileHover={{ y: -6, scale: 1.02 }}
                transition={{ duration: 0.3 }}
                className="group bg-white rounded-2xl p-6 shadow-card hover:shadow-card-hover transition-all duration-300 h-full"
              >
                {/* Icon */}
                <div className={`w-14 h-14 rounded-xl bg-gradient-to-br ${den.color} flex items-center justify-center mb-5`}>
                  <den.icon className="w-7 h-7 text-white" />
                </div>

                {/* Rank */}
                <h3 className="font-heading font-bold text-xl text-foreground mb-1 group-hover:text-scout-green transition-colors">
                  {den.rank}
                </h3>

                {/* Grade */}
                <p className="text-scout-orange font-semibold text-sm mb-3">
                  {den.grade}
                </p>

                {/* Description */}
                <p className="text-muted-foreground leading-relaxed">
                  {den.description}
                </p>
              </motion.div>
            </StaggerItem>
          ))}
        </StaggerContainer>

        {/* Meeting Info */}
        <ScrollReveal delay={0.6}>
          <div className="mt-16 bg-scout-green rounded-2xl p-8 text-white">
            <div className="grid md:grid-cols-2 gap-8">
              <div>
                <h3 className="font-heading font-bold text-2xl mb-4 flex items-center gap-3">
                  <Users className="w-6 h-6 text-scout-orange" />
                  Pack Meetings
                </h3>
                <p className="text-white/80 leading-relaxed mb-4">
                  The whole Pack (all dens) meets the first Thursday of every month at the 
                  Veterans Memorial Building, usually from 6:30 to 8pm. The entire family 
                  (including siblings) is welcome.
                </p>
                <div className="flex items-center gap-2 text-white/70">
                  <MapPin className="w-4 h-4 text-scout-orange" />
                  <span className="text-sm">Veterans Memorial Hall, 1325 Portland Avenue</span>
                </div>
              </div>
              
              <div>
                <h3 className="font-heading font-bold text-2xl mb-4 flex items-center gap-3">
                  <Calendar className="w-6 h-6 text-scout-orange" />
                  Den Meetings
                </h3>
                <p className="text-white/80 leading-relaxed mb-4">
                  Each den establishes its own meeting schedule, usually 1-2 times per month. 
                  At den meetings, Scouts work on advancements, learn skills, and always have a great time.
                </p>
                <p className="text-white/70 text-sm">
                  For Lion and Tiger Scouts, a parent is expected to join their Scout at meetings.
                </p>
              </div>
            </div>
          </div>
        </ScrollReveal>

        {/* Charter Info */}
        <ScrollReveal delay={0.7}>
          <div className="mt-8 text-center">
            <p className="text-muted-foreground text-sm">
              Pack 3 is in the Herms District of the Golden Gate Council and is chartered by the{' '}
              <span className="text-scout-green font-semibold">American Legion Post 292 of Albany</span>
            </p>
          </div>
        </ScrollReveal>
      </div>
    </section>
  );
}
