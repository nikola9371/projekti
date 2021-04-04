using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using projekat.Models;
using projekat.viewModel;

namespace projekat.Controllers
{
    public class CasoviController : Controller
    {
        private SkolaSEntities1 db = new SkolaSEntities1();
        private SkolaViewModel skolaView = new SkolaViewModel();

        // GET: Casovi
        [HttpGet]
        public ActionResult skiniMaterijal()
        {
            if (Session["userID"] == null) { return RedirectToAction("Index","Home"); }

            var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
            var KursFk = db.Students.Where(x => x.Korisnik_FK == korisnikid).Select(x => x.Kurs_FK).FirstOrDefault();
            var listaMaterijala = db.Materijals.Where(x => x.KursID == KursFk).ToList();
            //var listaMaterijala = db.Materijals.Join(db.Profesors, x => x.ProfesorID, y => y.ProfesorID, (x, y) => new { Materijal = x, Profesor = y }).Where(x => x.Materijal.StudentID == userid).ToList();
            skolaView.materijali = listaMaterijala;
            return View(skolaView);
        }
        [HttpGet]
        public ActionResult kaciMaterijal()
        {
            if (Session["userID"] == null) { return RedirectToAction("Index", "Home"); }

            var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
            var ListaKurseva = new SelectList(db.Kurs, "ID_Kurs", "Ime");
            var imeProfesora = db.Korisniks.Where(x => x.ID_Korisnik == korisnikid).Select(x => x.Ime).FirstOrDefault();
            var idProfesor = db.Profesors.Where(x => x.id_Korisnik_FK == korisnikid).Select(x => x.ProfesorID).FirstOrDefault();
            skolaView.KurseviLista = ListaKurseva;
            skolaView.imeProfesora = imeProfesora;

            if (TempData["SuccMsg"] != null)
            {
                ViewBag.SuccMsg = TempData["SuccMsg"];
            }
            else if (TempData["ErrorMsg"] != null)
            {
                ViewBag.ErrMsg = TempData["ErrorMsg"];
            }


            Materijal materijal = new Materijal { ProfesorID = idProfesor };
            skolaView.Materijal = materijal;

            if (TempData["ErrorNoFile"] != null)
            {
                ViewBag.NoFile = TempData["ErrorNoFile"];
            }
            return View(skolaView);
        }
        [HttpGet]
        public ActionResult Prisustvo()
        {
            if (Session["userID"] == null) { return RedirectToAction("Index", "Home"); }

            var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
            var idProfesor = db.Profesors.Where(x => x.id_Korisnik_FK == korisnikid).Select(x => x.ProfesorID).FirstOrDefault();
            var idCasPrisustvuje = db.prisustvujes.Select(x => x.CasID_FK).ToArray();
            var ListaCasova = new SelectList(db.Cas.Where(x => x.ProfesorID == idProfesor && !idCasPrisustvuje.Contains(x.ID_Cas)), "ID_Cas", "Datum");
            skolaView.CasoviLista = ListaCasova;

            if (TempData["SuccMsg"] != null)
            {
                ViewBag.SuccMsg = TempData["SuccMsg"];
            }

            return View(skolaView);
        }
        [HttpPost]
        public ActionResult beleziPrisustvo(int idCas)
        {
            var KursID = db.Cas.Where(x => x.ID_Cas == idCas).Select(x => x.KursID).FirstOrDefault();
            var listaStudenata = db.Students.Where(x => x.Kurs_FK == KursID).ToList();
            var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
            var idProfesor = db.Profesors.Where(x => x.id_Korisnik_FK == korisnikid).Select(x => x.ProfesorID).FirstOrDefault();
            var idCasPrisustvuje = db.prisustvujes.Select(x => x.CasID_FK).Distinct().ToArray();
            var ListaCasova = new SelectList(db.Cas.Where(x => x.ProfesorID == idProfesor && !idCasPrisustvuje.Contains(x.ID_Cas)), "ID_Cas", "Datum");

            skolaView.CasoviLista = ListaCasova;
            skolaView.studenti = listaStudenata;
            skolaView.idCas = idCas;
            return View("Prisustvo", skolaView);
        }
        [HttpPost]
        public ActionResult beleziPrisustvo2(SkolaViewModel skolaView)
        {
            foreach (var i in skolaView.studenti)
            {
                prisustvuje prisustvuje = new prisustvuje {
                    CasID_FK = skolaView.idCas,
                    StudentID_FK = i.StudentID,
                    prisutan = i.isChecked
                };
                db.prisustvujes.Add(prisustvuje);
                db.SaveChanges();
            }
            TempData["SuccMsg"] = "Uspešno upisano prisustvo";
            return RedirectToAction("Prisustvo");
        }
        [HttpGet]
        public ActionResult UpisivanjeCasa()
        {
            if (Session["userID"] == null) { return RedirectToAction("Index", "Home"); }

            var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
            var idProfesor = db.Profesors.Where(x => x.id_Korisnik_FK == korisnikid).Select(x => x.ProfesorID).FirstOrDefault();
            var imeProfesora = db.Korisniks.Where(x => x.ID_Korisnik == korisnikid).Select(x => x.Ime).FirstOrDefault();
            var ListaKurseva = new SelectList(db.Kurs, "ID_Kurs", "Ime");

            skolaView.KurseviLista = ListaKurseva;
            skolaView.imeProfesora = imeProfesora;
            Ca cas = new Ca { ProfesorID = idProfesor, Datum = DateTime.Today };
            skolaView.Cas = cas;

            if (TempData["SuccMsg"] != null)
            {
                ViewBag.SuccMsg = TempData["SuccMsg"];
            }

            return View(skolaView);
        }
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult upisiCas(Ca cas)
        {
            if (ModelState.IsValid)
            {
                db.Cas.Add(cas);
                db.SaveChanges();

                TempData["SuccMsg"] = "Uspešno unet novi čas";
                return RedirectToAction("UpisivanjeCasa");
            }
            else
            {
                ViewBag.ErrMsg = "Cas nije upisan!";
                var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
                var idProfesor = db.Profesors.Where(x => x.id_Korisnik_FK == korisnikid).Select(x => x.ProfesorID).FirstOrDefault();
                var imeProfesora = db.Korisniks.Where(x => x.ID_Korisnik == korisnikid).Select(x => x.Ime).FirstOrDefault();
                var ListaKurseva = new SelectList(db.Kurs, "ID_Kurs", "Ime");

                skolaView.KurseviLista = ListaKurseva;
                skolaView.imeProfesora = imeProfesora;
                Materijal materijal = new Materijal { ProfesorID = idProfesor };
                skolaView.Materijal = materijal;
                return View("UpisivanjeCasa", skolaView);
            }
        }
        [HttpGet]
        public ActionResult Zakljucivanje()
        {
            if (Session["userID"] == null) { return RedirectToAction("Index", "Home"); }

            var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
            var idProfesor = db.Profesors.Where(x => x.id_Korisnik_FK == korisnikid).Select(x => x.ProfesorID).FirstOrDefault();
            var idKurs = db.Cas.Where(x => x.ProfesorID == idProfesor).Select(x => x.KursID).Distinct().ToArray();
            var StudentiLista = new SelectList(db.Students.Where(x => idKurs.Contains(x.Kurs_FK)&&x.ZakljucnaOcena==null),"StudentID","Korisnik.Ime");
            skolaView.StudentiList = StudentiLista;

            if (TempData["SuccMsg"] != null)
            {
                ViewBag.SuccMsg = TempData["SuccMsg"];
            }
            return View(skolaView);
        }
        [HttpPost]
        public ActionResult Zakljucivanje1(int idStudent)
        {
            var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
            var idProfesor = db.Profesors.Where(x => x.id_Korisnik_FK == korisnikid).Select(x => x.ProfesorID).FirstOrDefault();
            var idKurs = db.Cas.Where(x => x.ProfesorID == idProfesor).Select(x => x.KursID).Distinct().ToArray();
            var StudentiLista = new SelectList(db.Students.Where(x => idKurs.Contains(x.Kurs_FK)), "StudentID", "Korisnik.Ime");
            var Student = db.Students.Find(idStudent);

            skolaView.Student = Student;
            skolaView.StudentiList = StudentiLista;

            return View("Zakljucivanje",skolaView);
        }
        [HttpPost]
        public ActionResult Zakljucivanje2(Student student)
        {
            db.Entry(student).State = System.Data.Entity.EntityState.Modified;
            db.Entry(student).Property("Korisnik_FK").IsModified = false;
            db.Entry(student).Property("Kurs_FK").IsModified = false;
            db.SaveChanges();

            TempData["SuccMsg"] = "Uspešno upisana zaključna ocena";

            return RedirectToAction("Zakljucivanje");
        }
        [HttpGet]
        public ActionResult GetPdf(string filename)
        {
            return File(Path.Combine(Server.MapPath("~/Pdf_Files/"), filename + ".pdf"), "application/pdf", filename + "||MaterijalSkola.pdf");
        }
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult okaciMaterijal(HttpPostedFileBase file, Materijal materijal)
        {
            if (ModelState.IsValid)
            {
                if (file != null)
                {
                    var extension = Path.GetExtension(file.FileName);

                    if (extension.Equals(".pdf"))
                    {
                        var fileNameWithoutExt = Path.GetFileNameWithoutExtension(file.FileName);
                        var fileName = Path.GetFileName(file.FileName);
                        var path = Path.Combine(Server.MapPath("~/Pdf_Files/"), fileName);
                        file.SaveAs(path);

                        materijal.Atribut = fileNameWithoutExt;
                        db.Materijals.Add(materijal);
                        db.SaveChanges();

                        TempData["SuccMsg"] = "Novi materijal je unet";
                        return RedirectToAction("kaciMaterijal");
                    }
                    else
                    {
                        TempData["ErrorMsg"] = "Format nije dobar, mora biti pdf!";
                        return RedirectToAction("kaciMaterijal");
                    }
                }
                else
                {
                    TempData["ErrorMsg"] = "Postavljanje materijala nije uspelo!";
                    TempData["ErrorNoFile"] = "Niste uneli fajl!";
                    return RedirectToAction("kaciMaterijal");
                }
            }
            else
            {
                ViewBag.ErrMsg = "Postavljanje materijala nije uspelo!";
                var korisnikid = Convert.ToInt32(Session["KorisnikID"]);
                var ListaKurseva = new SelectList(db.Kurs, "ID_Kurs", "Ime");
                var imeProfesora = db.Korisniks.Where(x => x.ID_Korisnik == korisnikid).Select(x => x.Ime).FirstOrDefault();
                var idProfesor = db.Profesors.Where(x => x.id_Korisnik_FK == korisnikid).Select(x => x.ProfesorID).FirstOrDefault();
                skolaView.KurseviLista = ListaKurseva;
                skolaView.imeProfesora = imeProfesora;
                skolaView.Materijal = materijal;

                return View("kaciMaterijal", skolaView);
            }
        }
        
    }
    
}