using FluentAssertions;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

using Users.API.Controllers;
using Users.API.Config;
using Users.API.Models;

namespace Users.Tests.Systems.Controllers;

public class TestUsersController
{
    [Fact]
    public async Task Get_OnSuccess_ReturnsStatusCode200()
    {
        var options = new DbContextOptionsBuilder<UserContext>()
            .UseInMemoryDatabase(databaseName: "TestDatabase")
            .Options;

        using (var context = new UserContext(options))
        {
            var testUsers = GetTestUsers();
            context.Users.AddRange(testUsers);
            context.SaveChanges();

            var controller = new UsersController(context);
            
            var result = await controller.GetUsers();

            result.Should().BeOfType<ActionResult<IEnumerable<User>>>();
            result.Value.Should().BeEquivalentTo(testUsers);
        }
    }

    private List<User> GetTestUsers()
    {
        var testUsers = new List<User>();
        testUsers.Add(new User { Id = 1, FirstName = "Name1", LastName = "Last1", Email = "email1@test.com" });
        testUsers.Add(new User { Id = 2, FirstName = "Name2", LastName = "Last2", Email = "email2@test.com" });
        testUsers.Add(new User { Id = 3, FirstName = "Name3", LastName = "Last3", Email = "email3@test.com" });
        testUsers.Add(new User { Id = 4, FirstName = "Name4", LastName = "Last4", Email = "email4@test.com" });

        return testUsers;
    }
}