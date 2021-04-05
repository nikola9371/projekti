using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Helpers;
using System.Web.Mvc;
using System.Web.Security;
using projekat.Models;


namespace projekat.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            //var sha = Crypto.SHA256("korisnik");
            //ViewBag.Message = sha;
            return View();
        }

        public ActionResult Registration()
        {


            return View();
        }
        //provera sifru i korisnicko ime pri logovanju
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Authorize(login userModel)
        {
            using (SkolaSEntities1 db = new SkolaSEntities1())
            {
                if (userModel.password == null)
                {
                    userModel.LoginErrorMessage = "Polja ne smeju biti prazna";
                    return View("Index", userModel);
                }
                else
                {
                    var hashedPass = Crypto.SHA256(userModel.password);
                    var userDetails = db.logins.Where(x => x.username.Equals(userModel.username) && x.password.Equals(hashedPass)).FirstOrDefault();
                    if (userDetails == null)
                    {
                        userModel.LoginErrorMessage = "Pogresno korisnicko ime ili sifra";
                        return View("Index", userModel);
                    }
                    else
                    {
                        Session["userID"] = userDetails.id_Login;
                        Session["UserName"] = userDetails.username;
                        Session["Role"] = userDetails.userType;
                        Session["KorisnikID"] = userDetails.korisnikID_FK;

                        return RedirectToAction("HomePage", "Home");
                    }
                }
            }
        }
        public ActionResult HomePage()
        {
            if (Session["userID"] == null) { return RedirectToAction("Index","Home"); }
            return View();
        }
        //Izbacuje nas iz sistema
        public ActionResult Logout()
        {
            int userId = (int)Session["userID"];
            Session.Abandon();
            return RedirectToAction("Index", "Home");
        }
    }
}