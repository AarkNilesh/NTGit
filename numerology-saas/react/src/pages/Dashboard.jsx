export default function Dashboard({ clients }) {
  const revenue = clients.length * 49;
  return (
    <section>
      <h1>Practitioner Dashboard</h1>
      <div className="cards">
        <article><b>{clients.length}</b><span>Clients</span></article>
        <article><b>{clients.length}</b><span>Reports</span></article>
        <article><b>${revenue}</b><span>Projected Revenue</span></article>
      </div>
    </section>
  );
}
