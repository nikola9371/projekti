using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using projekat.Models;
using Rotativa;
using System.Data.Entity.Validation;
using System.IO;

namespace projekat.Controllers
{
    public class ListaSkolasController : Controller
    {
        private projekatEntities db = new projekatEntities();

        // GET: ListaSkolas za korisnike sa pravom unosa
        public ActionResult IndexUser()
        {
            var listaSkolas = db.ListaSkolas.Include(l => l.KontaktOsoba);
            return View(listaSkolas.ToList());
        }
        // GET: ListaSkolas za korisnike sa pravom pregleda
        public ActionResult IndexUser2()
        {
            var listaSkolas = db.ListaSkolas.Include(l => l.KontaktOsoba);
            return View(listaSkolas.ToList());
        }
        // GET: ListaSkolas za korisnike administratore
        public ActionResult IndexAdmin()
        {
            var listaSkolas = db.ListaSkolas.Include(l => l.KontaktOsoba);
            return View(listaSkolas.ToList());
        }
        //GET:ListaSkolas podaci o skolama na stranici administratora
        public ActionResult DetailsAdmin(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ListaSkola listaSkola = db.ListaSkolas.Find(id);
            if (listaSkola == null)
            {
                return HttpNotFound();
            }
            return View(listaSkola);
        }
        //GET:ListaSkolas podaci o skolama na stranici korisnika sa pravom pregleda
        public ActionResult DetailsUser2(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ListaSkola listaSkola = db.ListaSkolas.Find(id);
            if (listaSkola == null)
            {
                return HttpNotFound();
            }
            return View(listaSkola);
        }
        // GET: ListaSkolas/Details/5 za korisnike sa pravom unosa
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ListaSkola listaSkola = db.ListaSkolas.Find(id);
            if (listaSkola == null)
            {
                return HttpNotFound();
            }
            return View(listaSkola);
        }
        
                // GET: ListaSkolas/Create za korisnike sa pravom unosa
                public ActionResult Create()
                {
                    ViewBag.KontaktOsobaFK = new SelectList(db.KontaktOsobas, "id", "ime");
                    return View();
                }

                // POST: ListaSkolas/Create
                // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
                // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
                [HttpPost]
                [ValidateAntiForgeryToken]
                public ActionResult Create([Bind(Include = "idS,NazivSkole,AdresaReg,Opstina,PostanskiBroj,MaticniBroj,pib,BrojRacuna,WebStranica,KontaktOsobaFK,Beleske")] ListaSkola listaSkola)
                {
                        
                if (ModelState.IsValid)
                    {

                        /*string fileName = Path.GetFileNameWithoutExtension(listaSkola.ImageFile.FileName);
                        string extension = Path.GetExtension(listaSkola.ImageFile.FileName);
                        fileName = fileName + DateTime.Now.ToString("yymmssfff") + extension;
                        listaSkola.SlikaPecat = "~/pics/" + fileName;
                        fileName = Path.Combine(Server.MapPath("~/pics/"), fileName);
                        listaSkola.ImageFile.SaveAs(fileName);*/

                        db.ListaSkolas.Add(listaSkola);
                        db.SaveChanges();

                        return RedirectToAction("IndexUser");
                    }

                    ViewBag.KontaktOsobaFK = new SelectList(db.KontaktOsobas, "id", "ime", listaSkola.KontaktOsobaFK);
                    return View(listaSkola);
                }
                
     
        // GET: logins/CreateKorisnik pravljenje novih korisnika 
        public ActionResult CreateKorisnik()
        {
            return View();
        }
        [HttpPost]
        public ActionResult AddUserAdmin(projekat.Models.login userModel)
        {
            using (projekatEntities db = new projekatEntities())
            {
                
                    
                db.logins.Add(userModel);
                db.SaveChanges();
                userModel.SuccessAddUserAdmin = "Uspesno dodat novi korisnik!";
                

            }

            return View("SuccessUserAdmin", userModel);
        }
        public ActionResult SuccessUserAdmin()
        {
            return View();
        }

        // GET: ListaSkolas/Create for administrators na stranici administratora
        public ActionResult CreateAdmin()
        {
            ViewBag.KontaktOsobaFK = new SelectList(db.KontaktOsobas, "id", "ime");
            return View();
        }
        // POST: ListaSkolas/CreateAdmin za stranicu administratora
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost, ActionName("CreateAdmin")]
        [ValidateAntiForgeryToken]
        public ActionResult CreateAdmin([Bind(Include = "idS,NazivSkole,AdresaReg,Opstina,PostanskiBroj,MaticniBroj,pib,BrojRacuna,WebStranica,KontaktOsobaFK,SlikaPecat,Beleske")] ListaSkola listaSkola)
        {
            if (ModelState.IsValid)
            {

                db.ListaSkolas.Add(listaSkola);
                db.SaveChanges();

                return RedirectToAction("IndexAdmin");
            }

            ViewBag.KontaktOsobaFK = new SelectList(db.KontaktOsobas, "id", "ime", listaSkola.KontaktOsobaFK);
            return View(listaSkola);
        }

        // GET: ListaSkolas/Edit/5 na stranici korisnika sa pravom unosa
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ListaSkola listaSkola = db.ListaSkolas.Find(id);
            if (listaSkola == null)
            {
                return HttpNotFound();
            }
            ViewBag.KontaktOsobaFK = new SelectList(db.KontaktOsobas, "id", "ime", listaSkola.KontaktOsobaFK);
            return View(listaSkola);
        }
        // GET: ListaSkolas/Edit/5 na stranici administratora
        public ActionResult EditAdmin(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ListaSkola listaSkola = db.ListaSkolas.Find(id);
            if (listaSkola == null)
            {
                return HttpNotFound();
            }
            ViewBag.KontaktOsobaFK = new SelectList(db.KontaktOsobas, "id", "ime", listaSkola.KontaktOsobaFK);
            return View(listaSkola);
        }

        // POST: ListaSkolas/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "idS,NazivSkole,AdresaReg,Opstina,PostanskiBroj,MaticniBroj,pib,BrojRacuna,WebStranica,KontaktOsobaFK,SlikaPecat,Beleske")] ListaSkola listaSkola)
        {
            if (ModelState.IsValid)
            {
                db.Entry(listaSkola).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("IndexUser");
            }
            ViewBag.KontaktOsobaFK = new SelectList(db.KontaktOsobas, "id", "ime", listaSkola.KontaktOsobaFK);
            return View(listaSkola);
        }
        // POST: ListaSkolas/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult EditAdmin([Bind(Include = "idS,NazivSkole,AdresaReg,Opstina,PostanskiBroj,MaticniBroj,pib,BrojRacuna,WebStranica,KontaktOsobaFK,SlikaPecat,Beleske")] ListaSkola listaSkola)
        {
            if (ModelState.IsValid)
            {
                db.Entry(listaSkola).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("IndexAdmin");
            }
            ViewBag.KontaktOsobaFK = new SelectList(db.KontaktOsobas, "id", "ime", listaSkola.KontaktOsobaFK);
            return View(listaSkola);
        }

        // GET: ListaSkolas/Delete/5 za korisnike sa pravom unosa
        public ActionResult Delete(int? id)
        {
            
                if (id == null)
                {
                    return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
                }
                ListaSkola listaSkola = db.ListaSkolas.Find(id);
                if (listaSkola == null)
                {
                    return HttpNotFound();
                }
                return View(listaSkola);
           /* try
            {
            }
            catch (Exception e)
            {
            //Redirect("")
            }*/
        }

        // POST: ListaSkolas/Delete/5 
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            ListaSkola listaSkola = db.ListaSkolas.Find(id);
            db.ListaSkolas.Remove(listaSkola);
            db.SaveChanges();
            return RedirectToAction("IndexUser");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
        //Pronalazi id od obrazca koji zelimo da stampamo
        public ActionResult IndexById(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ListaSkola listaSkola = db.ListaSkolas.Find(id);
            if (listaSkola == null)
            {
                return HttpNotFound();
            }
            return View(listaSkola);
        }
        //Stampanje obrazaca
        public ActionResult PrintSlip(int id)
        {
            var report = new ActionAsPdf("IndexById", new { id = id });
            return report;
        }
        public ActionResult PrikazKorisnika()
        {
            var Korisnici = db.logins;
            return View(Korisnici.ToList());
        }
        //GET: na stranici za unos korisnika
        public ActionResult EditKorisnika(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            login listaKorisnika = db.logins.Find(id);
            if (listaKorisnika == null)
            {
                return HttpNotFound();
            }
            ViewBag.userType = new SelectList(db.logins,"userType","userType",listaKorisnika.userType);
            
            return View(listaKorisnika);
        }
        //post
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult EditKorisnika([Bind(Include ="id,username,password,userType")] login logins)
        {
            if (ModelState.IsValid)
            {
                db.Entry(logins).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("PrikazKorisnika");
            }
            ViewBag.userType = new SelectList(db.logins, "userType","userType",logins.userType);
            return View(logins);
        }
        //POST: Podaci o korisnicima
        public ActionResult DetailsKorisnika(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            login listaKorisnika = db.logins.Find(id);
            if (listaKorisnika == null)
            {
                return HttpNotFound();
            }
            return View(listaKorisnika);
        }
        //POST: na stranici za unosa novih korisnika 
        public ActionResult DeleteKorisnika(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            login listaKorisnika = db.logins.Find(id);
            if (listaKorisnika == null)
            {
                return HttpNotFound();
            }
            return View(listaKorisnika);
        }
        //GET: na stranici za unosa novih korisnika 
        [HttpPost, ActionName("DeleteKorisnika")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmedKorisnici(int id)
        {
            login listaKorisnika = db.logins.Find(id);
            db.logins.Remove(listaKorisnika);
            db.SaveChanges();
            return RedirectToAction("PrikazKorisnika");
        }

      

    }
}
