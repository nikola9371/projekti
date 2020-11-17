using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using projekat.Models;


namespace projekat.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            return View();
        }

        public ActionResult Registration()
        {
            

            return View();
        }
        //salje potvrdnu poruku posle unosa novog korisnika
        public ActionResult SuccessAddUser()
        {
            return View();
        }
        // za unos novih korisnika
        [HttpPost]
        public ActionResult AddUser(projekat.Models.login userModel)
        {
                using (projekatEntities db = new projekatEntities())
                {
                    db.logins.Add(userModel);
                    db.SaveChanges();
                userModel.SuccessAddUser = "Uspesno dodat novi korisnik!";
                
                }

            return View("SuccessAddUser", userModel);

            
        }
        public ActionResult ListSchools(projekat.Models.ListaSkola userModel) {
            return View(userModel);
        }

        public new ActionResult User()
        {
            ViewBag.Message = "Dobrodosli korisnice";

            return View();
        }
        public ActionResult User2()
        {
            ViewBag.Message = "Dobrodosli korisnice2";
            return View();
        }
        public ActionResult Admin()
        {
            ViewBag.Message = "Dobrodosli administratore";
            return View();
        }
        //provera sifru i korisnicko ime pri logovanju
        [HttpPost]
        public ActionResult Authorize(projekat.Models.login userModel)
        {
            using (projekatEntities db=new projekatEntities())
            {
                var userDetails = db.logins.Where(x => x.username == userModel.username && x.password == userModel.password).FirstOrDefault();
                if (userDetails == null)
                {
                    userModel.LoginErrorMessage = "Pogresno korisnicko ime ili sifra";
                    return View("Index", userModel);
                }
                else
                {
                    Session["userID"] = userDetails.id;
                    Session["UserName"] = userDetails.username;
                    if (userDetails.userType.Equals("user"))
                    {
                        return RedirectToAction("User", "Home");
                    }
                    else if (userDetails.userType.Equals("admin"))
                    {
                        return RedirectToAction("Admin", "Home");
                    }
                    else if (userDetails.userType.Equals("user2"))
                    {
                        return RedirectToAction("User2", "Home");
                    }
                }
            }
            return View("Index");
        }
        public ActionResult UnosSkola()
        {
            return View();
        }
        //Izbacuje nas iz sistema
        public ActionResult Logout()
        {
            int userId = (int)Session["userID"];
            Session.Abandon();
            return RedirectToAction("Index", "Home");
        }

        public ActionResult vratiView()
        {
            return View("Admin");

        }

       
    }
}