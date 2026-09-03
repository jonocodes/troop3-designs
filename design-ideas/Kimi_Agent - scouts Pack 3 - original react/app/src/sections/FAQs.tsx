import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { ScrollReveal } from '@/components/ScrollReveal';
import { ChevronDown, Users, HelpCircle, DollarSign, Clock } from 'lucide-react';

const faqCategories = [
  {
    icon: Users,
    title: 'Who Can Participate?',
    content: `Anyone in kindergarten through fifth grades! Starting in 2018, we welcomed girls to join the cub scouts. We will be establishing dens at the outset of the Scouting season based on the number of Scouts who sign up in each grade. Den sizes are 10 or fewer.

Albany's Pack 3 has always prided itself on being an inclusive unit that represents the diversity of our community. We are strongly committed to creating a welcoming environment for all children who wish to join our Pack.

We are proud to be designated as an Inclusive Unit by Scouts for Equality and our leaders wear the "Scouts for Equality" badge on their uniforms to signal our dedication to a Scouting movement rooted in equality and free of discrimination.`,
  },
  {
    icon: HelpCircle,
    title: 'How Does Cub Scouts Work?',
    content: `Cub Scouts is a family program for all kids interested in having fun, learning life skills, building community, exploring the outdoors, becoming leaders and good citizens, and making friends.

The basic structure of the group is a "pack" – which includes the whole group of Scouts, from kindergarten through fifth grades. Each grade has one or more "dens" that meet in smaller groups to work on adventures to earn their rank.

Cub Scouts complete adventures as they work to achieve their rank for that year. The adventures are different for each rank, allowing Cub Scouts to learn new age-appropriate skills and explore new topics each year. At the end of the year, if a Scout has met all of the requirements for that year, he or she will receive the rank (i.e. a first grader would receive the "Tiger" rank).`,
  },
  {
    icon: Users,
    title: 'What Are the Ranks?',
    content: `• Kindergarten = Lion
• First Grade = Tiger
• Second Grade = Wolf
• Third Grade = Bear
• Fourth Grade = Webelos (We Be Loyal Scouts)
• Fifth Grade = Arrow of Light (AOL)

In their fifth grade year, scouts "bridge" to Boy Scouts. This involves visiting local troops and choosing one that the scout will participate in and contribute to during their further adventures in Scouting.`,
  },
  {
    icon: DollarSign,
    title: 'How Much Does Cub Scouts Cost?',
    content: `Annual registration fee is $300.00 per child ($275 for returning scouts) paid by check or Zelle to our treasurer. Fees cover activities, achievements, badges and a "Class B" Pack t-shirt for your Scout. Lion and Tiger Scouts also require a parent to register with Pack 3 as an adult leader for $15.

The basic uniform consists of a shirt, hat, neckerchief, neckerchief slide, and the pack and council patches. This can add up to $100 or so. (Our pack re-uses shirts and gear so check with us before buying!) The hat, neckerchief and slide will change with the different grades, but the same blue shirt can be used from kindergarten through third grade. In fourth and fifth grades, Scouts switch to a tan-colored shirt.

A limited number of scholarships are available for those in need.`,
  },
  {
    icon: Clock,
    title: 'What Is the Time Commitment?',
    content: `The Pack meets once a month on a Thursday evening from 6:30 to 7:30. The dens meet once or twice monthly on a day selected by the den.

In addition, there are at least two family campouts per year, one in fall (October) and one in the spring (April), which are usually Friday to Sunday. For 2025-2026, we have scheduled 2 additional campouts for a total of 4 campouts!

Other activities include:
• Pinewood Derby (Sunday in January)
• Pancake Breakfast (Sunday in February)
• Bake sale (April)
• Community service projects
• Fall and spring hikes

Lion and Tiger parents need to complete Youth Protection Training online (takes about one hour).`,
  },
];

function FAQItem({ item, isOpen, onToggle }: { item: typeof faqCategories[0]; isOpen: boolean; onToggle: () => void }) {
  return (
    <div className="border-b border-border last:border-b-0">
      <button
        onClick={onToggle}
        className="w-full py-6 flex items-start gap-4 text-left group"
      >
        <div className="w-10 h-10 bg-scout-green/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-scout-green/20 transition-colors">
          <item.icon className="w-5 h-5 text-scout-green" />
        </div>
        <div className="flex-1">
          <h3 className="font-heading font-bold text-lg text-foreground group-hover:text-scout-green transition-colors">
            {item.title}
          </h3>
        </div>
        <motion.div
          animate={{ rotate: isOpen ? 180 : 0 }}
          transition={{ duration: 0.2 }}
          className="w-8 h-8 bg-scout-orange/10 rounded-full flex items-center justify-center flex-shrink-0"
        >
          <ChevronDown className="w-5 h-5 text-scout-orange" />
        </motion.div>
      </button>
      <AnimatePresence>
        {isOpen && (
          <motion.div
            initial={{ height: 0, opacity: 0 }}
            animate={{ height: 'auto', opacity: 1 }}
            exit={{ height: 0, opacity: 0 }}
            transition={{ duration: 0.3 }}
            className="overflow-hidden"
          >
            <div className="pb-6 pl-14 pr-4">
              <div className="text-muted-foreground leading-relaxed whitespace-pre-line">
                {item.content}
              </div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  );
}

export function FAQs() {
  const [openIndex, setOpenIndex] = useState<number | null>(0);

  return (
    <section id="faqs" className="py-20 bg-muted/30">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-16">
          <ScrollReveal>
            <span className="inline-block text-scout-orange font-semibold text-sm uppercase tracking-wide mb-4">
              Got Questions?
            </span>
          </ScrollReveal>
          
          <ScrollReveal delay={0.1}>
            <h2 className="font-heading text-4xl sm:text-5xl font-bold text-foreground mb-4">
              Frequently Asked <span className="text-scout-green">Questions</span>
            </h2>
          </ScrollReveal>
          
          <ScrollReveal delay={0.2}>
            <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
              Everything you need to know about joining and participating in Albany Pack 3.
            </p>
          </ScrollReveal>
        </div>

        {/* FAQ Items */}
        <ScrollReveal delay={0.3}>
          <div className="bg-white rounded-2xl shadow-card p-6">
            {faqCategories.map((item, index) => (
              <FAQItem
                key={item.title}
                item={item}
                isOpen={openIndex === index}
                onToggle={() => setOpenIndex(openIndex === index ? null : index)}
              />
            ))}
          </div>
        </ScrollReveal>

        {/* Contact CTA */}
        <ScrollReveal delay={0.5}>
          <div className="mt-12 text-center">
            <p className="text-muted-foreground mb-4">
              Still have questions? Contact our Cubmaster!
            </p>
            <a
              href="mailto:cubmaster@albanycubscouts.org"
              className="inline-flex items-center gap-2 text-scout-green font-semibold hover:text-scout-orange transition-colors"
            >
              cubmaster@albanycubscouts.org
            </a>
          </div>
        </ScrollReveal>
      </div>
    </section>
  );
}
