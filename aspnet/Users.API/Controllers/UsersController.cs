using Microsoft.AspNetCore.Mvc;
using System.Threading.Tasks;
using Users.API.Models;
using System.Linq;
using Microsoft.EntityFrameworkCore;
using Microsoft.AspNetCore.Mvc.ViewFeatures.Buffers;
using Users.API.Config;

namespace Users.API.Controllers;

[ApiController]
[Route("api/[controller]")]
public class UsersController : ControllerBase
{
    private readonly UserContext _context;

    public UsersController(UserContext context)
    {
        _context = context;
    }

    [HttpGet]
    public async Task<ActionResult<IEnumerable<User>>> GetUsers()
    {
        return await _context.Users.ToListAsync();
    }

    [HttpGet("{id}")]
    public async Task<ActionResult<User>> GetUser(int id)
    {
        var user = await _context.Users.FindAsync(id);

        if (user == null)
        {
            return NotFound();
        }

        return user;
    }

    [HttpPost]
    public async Task<ActionResult<User>> PostUser(User user)
    {
        _context.Users.Add(user);
        await _context.SaveChangesAsync();

        return CreatedAtAction(nameof(GetUser), new { id = user.Id }, user);
    }

    [HttpPut("{id}")]
    public async Task<IActionResult> PutUser(int id, User user)
    {
        if (id != user.Id)
        {
            return BadRequest();
        }

        _context.Entry(user).State = EntityState.Modified;
        await _context.SaveChangesAsync();

        return NoContent();
    }

    [HttpDelete("{id}")]
    public async Task<IActionResult> DeleteUser(int id)
    {
        var user = await _context.Users.FindAsync(id);

        if (user == null)
        {
            return NotFound();
        }

        _context.Users.Remove(user);
        await _context.SaveChangesAsync();

        return NoContent();
    }

    [HttpGet("test")]
    public string Test()
    {
        return "Hello world!";
    }
}

[Route("test/")]
public class UsersViewController : Controller
{
    private UserContext _context;
    public UsersViewController(UserContext context)
    {
        _context = context;
    }

    [HttpGet("New")]
    public IActionResult New()
    {
        return View();
    }

    [HttpPost("Rem")]
    public async Task<IActionResult> Rem(int id)
    {
        var del = _context.Users.Where(x => x.Id == id).FirstOrDefault();
        _context.Users.Remove(del);
        await _context.SaveChangesAsync();
        return RedirectToAction(nameof(Index));
    }

    [HttpPost("Edit")]
    public async Task<IActionResult> Edit(User user)
    {
        if (ModelState.IsValid)
        {
            _context.Update(user);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }
        else
            return View(user);
    }

    [HttpPost("New")]
    public async Task<IActionResult> New(User user)
    {
        if (ModelState.IsValid)
        {
            _context.Add(user);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }
        else    
            return View();
    }

    [HttpGet("Edit/{id}")]
    public IActionResult Edit(int id)
    {
        var del = _context.Users.Where(x => x.Id == id).FirstOrDefault();
        return View(del);
    }

    [HttpGet("Index")]
    public IActionResult Index()
    {
        var list = _context.Users.ToList();
        return View(list);
    }
}