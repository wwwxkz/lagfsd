using Users.API.Models;
using Microsoft.EntityFrameworkCore;

namespace Users.API.Config
{
    public class UserContext : DbContext 
    {
        public UserContext(DbContextOptions<UserContext> options) : base(options)
        {
        }
        public DbSet<User> Users { get; set; }
    }

}
