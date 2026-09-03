import { Header } from './sections/Header';
import { Hero } from './sections/Hero';
import { QuickLinks } from './sections/QuickLinks';
import { Welcome } from './sections/Welcome';
import { Organization } from './sections/Organization';
import { Activities } from './sections/Activities';
import { ScoutOath } from './sections/ScoutOath';
import { WhyScouting } from './sections/WhyScouting';
import { FAQs } from './sections/FAQs';
import { Footer } from './sections/Footer';

function App() {
  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main>
        <Hero />
        <QuickLinks />
        <Welcome />
        <Organization />
        <Activities />
        <ScoutOath />
        <WhyScouting />
        <FAQs />
      </main>
      <Footer />
    </div>
  );
}

export default App;
