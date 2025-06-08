using Cassandra;
using Practica15DBD.Model;

namespace Practica15DBD.Repositories
{
    public class UserRepository
    {
        private readonly Cassandra.ISession _session;

        public UserRepository()
        {
            var cluster = Cluster.Builder()
                .AddContactPoint("localhost") // O IP donde esté Cassandra
                .WithPort(9042)
                .Build();
            _session = cluster.Connect("testks");
        }

        public IEnumerable<UserModel> GetUsers()
        {
            var rs = _session.Execute("SELECT id, name, email FROM users");
            foreach (var row in rs)
            {
                yield return new UserModel
                {
                    Id = row.GetValue<Guid>("id"),
                    Name = row.GetValue<string>("name"),
                    Email = row.GetValue<string>("email")
                };
            }
        }

        public void AddUser(UserModel user)
        {
            var ps = _session.Prepare("INSERT INTO users (id, name, email) VALUES (?, ?, ?)");
            _session.Execute(ps.Bind(user.Id, user.Name, user.Email));
        }

        public void UpdateUser(UserModel user)
        {
            var ps = _session.Prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            _session.Execute(ps.Bind(user.Name, user.Email, user.Id));
        }

        public void DeleteUser(Guid id)
        {
            var ps = _session.Prepare("DELETE FROM users WHERE id = ?");
            _session.Execute(ps.Bind(id));
        }

        public UserModel GetUser(Guid id)
        {
            var ps = _session.Prepare("SELECT id, name, email FROM users WHERE id = ?");
            var row = _session.Execute(ps.Bind(id)).FirstOrDefault();
            if (row == null) return null;
            return new UserModel
            {
                Id = row.GetValue<Guid>("id"),
                Name = row.GetValue<string>("name"),
                Email = row.GetValue<string>("email")
            };
        }
    }
}
