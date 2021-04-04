using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using projekat.Models;

namespace projekat.viewModel
{
    public class SkolaViewModel
    {
        public IEnumerable<Materijal> materijali { get; set; }
        public List<Student> studenti { get; set; }
        public Student Student { get; set; }
        public Materijal Materijal { get; set; }
        public prisustvuje Prisustvuje { get; set; }
        public Ca Cas { get; set; }
        public IEnumerable<SelectListItem> KurseviLista { get; set; }
        public IEnumerable<SelectListItem> CasoviLista { get; set; }
        public IEnumerable<SelectListItem> StudentiList { get; set; }
        public string imeKursa { get; set; }
        public string imeProfesora { get; set; }
        public int idCas { get; set; }
        public int idStudent { get; set; }
    }
}