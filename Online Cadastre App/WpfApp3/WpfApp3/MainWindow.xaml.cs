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
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace WpfApp3
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        private KatastarDataContext katastar = new KatastarDataContext();
        public MainWindow()
        {
            InitializeComponent();
        }

        private void MenuItem_Click(object sender, RoutedEventArgs e)
        {
            Window1 window = new Window1();
            window.ShowDialog();
        }
        private void puniKombo()
        {
            var katOpstine = katastar.KatastarskeOpstines;
            cmbKatastar.ItemsSource = katOpstine;
        }
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            puniKombo();
            rbPrivatno.IsChecked = true;
        }
        private void puniGrid()
        {
            var idKatOpstina = int.Parse(((KatastarskeOpstine)cmbKatastar.SelectedValue).IDKatOpstina.ToString());
            var Objekti = katastar.Parceles.Where(x => x.IDKatOpstina == idKatOpstina);
            datagrid1.ItemsSource = Objekti;

            var Neuknjizeni = katastar.Objektis.Where(x => x.IDKatOpstina == idKatOpstina && x.Uknjizeno == false).Count();
            tbBrNeuknjizenih.Text = Neuknjizeni.ToString();
        }
        private void CmbKatastar_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            puniGrid();
        }

        private void Datagrid1_LoadingRowDetails(object sender, DataGridRowDetailsEventArgs e)
        {
            var idKatOpstine = int.Parse(((KatastarskeOpstine)cmbKatastar.SelectedValue).IDKatOpstina.ToString());
            var idObj = int.Parse(((Parcele)datagrid1.SelectedValue).IDParcele.ToString());
            var objekti = katastar.Objektis.Where(x => x.IDParcele == idObj&&x.IDKatOpstina==idKatOpstine).FirstOrDefault();

            if (objekti != null)
            {
                TextBox tb1 = e.DetailsElement.FindName("txtSifrObjek") as TextBox;
                tb1.Text = objekti.IDObjekta.ToString();
                TextBox tb2 = e.DetailsElement.FindName("txtKvadr") as TextBox;
                tb2.Text = objekti.Kvadratura.ToString();
                TextBox tb3 = e.DetailsElement.FindName("txtVlasnik") as TextBox;
                tb3.Text = objekti.Vlasnik;
                CheckBox cb1 = e.DetailsElement.FindName("cbUknjizeno") as CheckBox;
                cb1.IsChecked = objekti.Uknjizeno;
                txtSifraParcelaNovo.Text = objekti.IDParcele.ToString();
            }
        }
        private string vratiVlasnistvo()
        {
            string pom = "";

            foreach (RadioButton i in boxVlasnistvo.Children)
            {
                if (i.IsChecked == true)
                    pom = i.Content.ToString();
            }
            return pom;
        }
        private void Button_Click(object sender, RoutedEventArgs e)
        {
            string vlasnistvo = vratiVlasnistvo();
            if (!String.IsNullOrEmpty(txtSifraParcelaNovo.Text)&&!String.IsNullOrEmpty(vlasnistvo)&&!String.IsNullOrEmpty(cmbKatastar.Text))
            {
                var idParcel = int.Parse(txtSifraParcelaNovo.Text);
                var idKarOpstina = int.Parse(((KatastarskeOpstine)cmbKatastar.SelectedValue).IDKatOpstina.ToString());
                var Naziv = ((KatastarskeOpstine)cmbKatastar.SelectedValue).Naziv;

                var Parcela = katastar.Parceles.Where(x => x.IDKatOpstina == idKarOpstina && x.IDParcele == idParcel).FirstOrDefault();

                Parcela.Vlasnistvo = vlasnistvo;

                try
                {
                    katastar.SubmitChanges();
                    MessageBox.Show("Vlasnistvo za parcelu " + idParcel + " u katarstarskoj opstini " + Naziv + " je uspesno izmenjen u bazi", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
                    puniGrid();
                }
                catch (Exception ex)
                {

                    MessageBox.Show("Nije izmenjeno u bazi " + ex.Message);
                }


                
            }
            else
            {
                MessageBox.Show("Polje je prazno", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
            }
        }

        private void MenuItem_Click_1(object sender, RoutedEventArgs e)
        {
            var idKat = int.Parse(((Parcele)datagrid1.SelectedValue).IDKatOpstina.ToString());
            var objekt = katastar.Objektis.Where(x => x.IDKatOpstina == idKat).FirstOrDefault();

            MessageBoxResult rez = MessageBox.Show("Da li si siguran da zelis da izbrises objekat?", "Obavestenje", MessageBoxButton.YesNo, MessageBoxImage.Question);

            if (rez == MessageBoxResult.Yes)
            {
                katastar.Objektis.DeleteOnSubmit(objekt);
                puniGrid();
                try
                {
                    katastar.SubmitChanges();
                    MessageBox.Show("Uspesno obrisan objekat","Obavestenje",MessageBoxButton.OK,MessageBoxImage.Information);

                }
                catch (Exception ex)
                {

                    MessageBox.Show("Nije izbrisan " + ex.Message);
                }
            }
        }
    }
}
