import { motion } from 'framer-motion';
import { ScrollReveal, StaggerContainer, StaggerItem } from '@/components/ScrollReveal';
import { Button } from '@/components/ui/button';
import { Calendar, MapPin, ArrowRight, Tent, Car, Egg, UtensilsCrossed, Flag, TreePine, HeartHandshake, Bike } from 'lucide-react';

const activities = [
  {
    title: 'Pinewood Derby',
    description: 'Scouts build and race their own model cars! One of our most exciting annual events.',
    date: 'January (Sunday)',
    location: 'Veterans Memorial Building',
    image: '/images/activity-derby.jpg',
    icon: Car,
  },
  {
    title: 'Family Campouts',
    description: 'Typically at least one each in the spring & fall. Great for bonding and outdoor skills!',
    date: 'Spring & Fall',
    location: 'Various Campgrounds',
    image: '/images/activity-camping.jpg',
    icon: Tent,
  },
  {
    title: 'Pancake Breakfast',
    description: 'Our annual fundraiser held in the Veterans Memorial Building. Scouts sell tickets and help serve!',
    date: 'February (Sunday)',
    location: 'Veterans Memorial Building',
    image: '/images/activity-service.jpg',
    icon: UtensilsCrossed,
  },
  {
    title: 'Annual Egg Drop',
    description: "Yes, it's exactly what it sounds like! A fun engineering challenge for scouts.",
    date: 'Spring',
    location: 'TBD',
    image: '/images/activity-hiking.jpg',
    icon: Egg,
  },
];

const otherActivities = [
  { name: 'Hiking (local park trails)', icon: TreePine },
  { name: 'Community Service', icon: HeartHandshake },
  { name: 'Flag Placement on Veterans\' Graves', icon: Flag },
  { name: 'Ice Skating', icon: Bike },
  { name: 'Bike Rides', icon: Bike },
  { name: 'Water Park', icon: Tent },
  { name: 'Blue and Gold Banquet', icon: UtensilsCrossed },
];

export function Activities() {
  return (
    <section id="activities" className="py-20 bg-background">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-16">
          <ScrollReveal>
            <span className="inline-block text-scout-orange font-semibold text-sm uppercase tracking-wide mb-4">
              Pack 3 Activities
            </span>
          </ScrollReveal>
          
          <ScrollReveal delay={0.1}>
            <h2 className="font-heading text-4xl sm:text-5xl font-bold text-foreground mb-4">
              What's it like to be in <span className="text-scout-green">Pack 3?</span>
            </h2>
          </ScrollReveal>
          
          <ScrollReveal delay={0.2}>
            <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
              Check out some of our annual activities. From outdoor adventures to 
              community service, there's always something exciting happening!
            </p>
          </ScrollReveal>
        </div>

        {/* Activities Grid */}
        <StaggerContainer className="grid md:grid-cols-2 gap-8" staggerDelay={0.15}>
          {activities.map((activity) => (
            <StaggerItem key={activity.title}>
              <motion.div
                whileHover={{ y: -8 }}
                transition={{ duration: 0.3 }}
                className="group bg-white rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover transition-shadow duration-300"
              >
                {/* Image */}
                <div className="relative h-56 overflow-hidden">
                  <img 
                    src={activity.image}
                    alt={activity.title}
                    className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent" />
                  <div className="absolute top-4 left-4 w-12 h-12 bg-white/90 rounded-xl flex items-center justify-center">
                    <activity.icon className="w-6 h-6 text-scout-green" />
                  </div>
                </div>

                {/* Content */}
                <div className="p-6">
                  <h3 className="font-heading font-bold text-xl text-foreground mb-2 group-hover:text-scout-green transition-colors">
                    {activity.title}
                  </h3>
                  <p className="text-muted-foreground mb-4">
                    {activity.description}
                  </p>
                  
                  <div className="flex flex-wrap gap-4 text-sm text-muted-foreground">
                    <div className="flex items-center gap-2">
                      <Calendar className="w-4 h-4 text-scout-orange" />
                      <span>{activity.date}</span>
                    </div>
                    <div className="flex items-center gap-2">
                      <MapPin className="w-4 h-4 text-scout-orange" />
                      <span>{activity.location}</span>
                    </div>
                  </div>
                </div>
              </motion.div>
            </StaggerItem>
          ))}
        </StaggerContainer>

        {/* Other Activities */}
        <ScrollReveal delay={0.6}>
          <div className="mt-16">
            <h3 className="font-heading font-bold text-2xl text-foreground text-center mb-8">
              More Pack Activities
            </h3>
            <div className="flex flex-wrap justify-center gap-4">
              {otherActivities.map((item, idx) => (
                <motion.div
                  key={item.name}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: 0.7 + idx * 0.05 }}
                  whileHover={{ scale: 1.05 }}
                  className="flex items-center gap-3 bg-white px-5 py-3 rounded-full shadow-sm"
                >
                  <item.icon className="w-5 h-5 text-scout-green" />
                  <span className="text-foreground font-medium">{item.name}</span>
                </motion.div>
              ))}
            </div>
          </div>
        </ScrollReveal>

        {/* Community Service Note */}
        <ScrollReveal delay={0.8}>
          <div className="mt-12 bg-scout-green/5 rounded-2xl p-8 border border-scout-green/10">
            <h4 className="font-heading font-bold text-xl text-scout-green mb-4 flex items-center gap-3">
              <HeartHandshake className="w-6 h-6" />
              Community Service
            </h4>
            <p className="text-muted-foreground leading-relaxed">
              Our scouts participate in various community service activities including:
              Scouting for Food, Earth Day cleanup, Storm drain stewardship, Beach Cleanup, 
              and Flag Placement on holidays at Veterans' cemetery. Pack activities are 
              communicated via email.
            </p>
          </div>
        </ScrollReveal>

        {/* View Calendar Button */}
        <ScrollReveal delay={0.9}>
          <div className="text-center mt-12">
            <Button 
              size="lg"
              className="bg-scout-orange hover:bg-scout-orange-dark text-white font-semibold px-8"
            >
              View Pack Calendar
              <ArrowRight className="ml-2 w-5 h-5" />
            </Button>
          </div>
        </ScrollReveal>
      </div>
    </section>
  );
}
