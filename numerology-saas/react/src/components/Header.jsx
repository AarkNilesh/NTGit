export default function Header({ view, setView }) {
  return (
    <header className="header">
      <strong>🔮 Numerology SaaS</strong>
      <nav>
        {['dashboard', 'clients', 'report'].map((item) => (
          <button className={view === item ? 'active' : ''} key={item} onClick={() => setView(item)}>
            {item}
          </button>
        ))}
      </nav>
    </header>
  );
}
