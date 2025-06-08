using Microsoft.AspNetCore.Mvc;
using Practica15DBD.Model;
using Practica15DBD.Repositories;

namespace Practica15DBD.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class UserController : ControllerBase
    {
        private readonly UserRepository _userRepository;

        public UserController()
        {
            _userRepository = new UserRepository();
        }

        // GET: api/User
        [HttpGet]
        public IEnumerable<UserModel> Get()
        {
            return _userRepository.GetUsers();
        }

        // GET: api/User/{id}
        [HttpGet("{id}")]
        public ActionResult<UserModel> Get(Guid id)
        {
            var user = _userRepository.GetUser(id);
            if (user == null) return NotFound();
            return user;
        }

        // POST: api/User
        [HttpPost]
        public ActionResult<UserModel> Post([FromBody] UserModel user)
        {
            user.Id = Guid.NewGuid();
            _userRepository.AddUser(user);
            return CreatedAtAction(nameof(Get), new { id = user.Id }, user);
        }

        // PUT: api/User/{id}
        [HttpPut("{id}")]
        public IActionResult Put(Guid id, [FromBody] UserModel user)
        {
            var existingUser = _userRepository.GetUser(id);
            if (existingUser == null) return NotFound();

            user.Id = id;
            _userRepository.UpdateUser(user);
            return NoContent();
        }

        // DELETE: api/User/{id}
        [HttpDelete("{id}")]
        public IActionResult Delete(Guid id)
        {
            var existingUser = _userRepository.GetUser(id);
            if (existingUser == null) return NotFound();

            _userRepository.DeleteUser(id);
            return NoContent();
        }
    }
}
