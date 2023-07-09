using System.ComponentModel.DataAnnotations.Schema;

namespace Users.API.Models;

[Table("users")]
public class User 
{
    [Column("id")]
    public int Id { get; set; }

    [Column("first_name")]
    public string FirstName { get; set; }
    
    [Column("last_name")]
    public string LastName { get; set; }
    
    [Column("email")]
    public string Email { get; set; }
}