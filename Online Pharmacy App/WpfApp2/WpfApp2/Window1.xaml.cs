using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;

namespace WpfApp2
{
    /// <summary>
    /// Interaction logic for Window1.xaml
    /// </summary>
    public partial class Window1 : Window
    {
        private ApotekaDataContext apoteka = new ApotekaDataContext();
        public Window1()
        {
            InitializeComponent();
        }
        private void isprazni()
        {
            txtIme.Text = "";
            txtPrezime.Text = "";
            txtSifra.Text = "";
            cmbDijagnoza.SelectedIndex = -1;
            cmbSfrLeka.SelectedIndex = -1;
        }
        private void Button_Click(object sender, RoutedEventArgs e)
        {
            isprazni();
            this.Close();
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
            if (!String.IsNullOrEmpty(txtIme.Text) && !String.IsNullOrEmpty(txtPrezime.Text) && !String.IsNullOrEmpty(txtSifra.Text) && cmbDijagnoza.SelectedIndex > -1 && cmbSfrLeka.SelectedIndex > -1)
            {
                Recept recept = new Recept()
                {
                    ReceptID = (int.Parse)(txtSifra.Text),
                    Ime = txtIme.Text,
                    Prezime = txtPrezime.Text,
                    SifraBolesti = (int.Parse)(((Dijagnoza)cmbDijagnoza.SelectedValue).SifraBolesti.ToString()),
                    SifraLeka=(int.Parse)(((Terapija)cmbSfrLeka.SelectedValue).SifraLeka.ToString()),
                };

                apoteka.Recepts.InsertOnSubmit(recept);

                try
                {
                    apoteka.SubmitChanges();
                    MessageBox.Show("Uspesno dodat novi recept", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
                }
                catch (Exception ex)
                {

                    MessageBox.Show("Nije dodat novi recept" + ex.Message);
                }
            }
            else
            {
                MessageBox.Show("Sve mora biti popunjeno", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
            }
        }
        private void napuniKombo()
        {
            var Dijagnoza = apoteka.Dijagnozas;
            cmbDijagnoza.ItemsSource = Dijagnoza;
        }
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            napuniKombo();
        }
        private void poDijagnozi()
        {
            if (cmbDijagnoza.SelectedValue == null)
            {

            }
            else
            {
                cmbSfrLeka.ItemsSource = null;

                int idBolest = int.Parse(((Dijagnoza)cmbDijagnoza.SelectedValue).SifraBolesti.ToString());
                var Terapija = apoteka.Terapijas.Where(x => x.SifraBolesti == idBolest);
                cmbSfrLeka.ItemsSource = Terapija;
            }
        }
        private void CmbDijagnoza_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            poDijagnozi();
        }

        private void CmbSfrLeka_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if (cmbSfrLeka.SelectedValue == null)
            {
                cmbSfrLeka.ItemsSource = null;
            }
        }
    }
}
