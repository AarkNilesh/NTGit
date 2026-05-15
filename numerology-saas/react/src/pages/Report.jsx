export default function Report({ selected }) {
  if (!selected) return <section className="panel"><h1>No report yet</h1><p>Add a client to generate a chart.</p></section>;
  return (
    <section className="panel">
      <h1>{selected.fullName} Report</h1>
      <div className="cards small">
        <article><b>{selected.report.lifePath}</b><span>Life Path</span></article>
        <article><b>{selected.report.destiny}</b><span>Destiny</span></article>
        <article><b>{selected.report.soulUrge}</b><span>Soul Urge</span></article>
        <article><b>{selected.report.personality}</b><span>Personality</span></article>
      </div>
      <p>{selected.report.content}</p>
      <button onClick={() => window.print()}>Download / Print PDF</button>
    </section>
  );
}
