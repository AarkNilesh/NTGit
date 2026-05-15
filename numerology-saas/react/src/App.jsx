import { useMemo, useState } from 'react';
import Header from './components/Header.jsx';
import Dashboard from './pages/Dashboard.jsx';
import Clients from './pages/Clients.jsx';
import Report from './pages/Report.jsx';
import { buildReport } from './services/numerology.js';

export default function App() {
  const [view, setView] = useState('dashboard');
  const [clients, setClients] = useState([]);
  const selected = useMemo(() => clients.at(-1), [clients]);

  function addClient(profile) {
    const client = { id: crypto.randomUUID(), ...profile, report: buildReport(profile) };
    setClients((current) => [...current, client]);
    setView('report');
  }

  return (
    <>
      <Header view={view} setView={setView} />
      <main>
        {view === 'dashboard' && <Dashboard clients={clients} />}
        {view === 'clients' && <Clients clients={clients} addClient={addClient} />}
        {view === 'report' && <Report selected={selected} />}
      </main>
    </>
  );
}
