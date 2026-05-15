export default function Clients({ clients, addClient }) {
  function submit(event) {
    event.preventDefault();
    const form = new FormData(event.currentTarget);
    addClient({ fullName: form.get('fullName'), birthDate: form.get('birthDate'), phone: form.get('phone') });
    event.currentTarget.reset();
  }

  return (
    <section className="layout">
      <form className="panel" onSubmit={submit}>
        <h2>Add Client</h2>
        <label>Full name<input name="fullName" required /></label>
        <label>Birth date<input name="birthDate" type="date" required /></label>
        <label>WhatsApp<input name="phone" /></label>
        <button>Add and Generate</button>
      </form>
      <div className="panel">
        <h2>Client CRM</h2>
        {clients.map((client) => <p key={client.id}><b>{client.fullName}</b><br />{client.birthDate}</p>)}
      </div>
    </section>
  );
}
