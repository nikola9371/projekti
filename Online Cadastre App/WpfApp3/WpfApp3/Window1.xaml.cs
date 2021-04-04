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

namespace WpfApp3
{
    /// <summary>
    /// Interaction logic for Window1.xaml
    /// </summary>
    public partial class Window1 : Window
    {
        private KatastarDataContext katastar = new KatastarDataContext();

        private void puniKOmbo()
        {
            var kat = katastar.KatastarskeOpstines;
            cmbKatOpstine.ItemsSource = kat;
        }
        public Window1()
        {
            InitializeComponent();
            puniKOmbo();
        }

        private void CmbKatOpstine_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if (cmbKatOpstine.SelectedValue != null)
            {
                var idKat = int.Parse(((KatastarskeOpstine)cmbKatOpstine.SelectedValue).IDKatOpstina.ToString());
                var parcele = katastar.Parceles.Where(x => x.IDKatOpstina == idKat);

                lbParcele.ItemsSource = parcele;
            }
        }
        private void Odustani()
        {
            txtKvadratura.Text = "";
            txtSifra.Text = "";
            txtVlasnik.Text = "";
            ckUknjizeno.IsChecked = false;
            cmbKatOpstine.SelectedIndex = -1;
            lbParcele.SelectedIndex = -1;
        }
        private void BtOdustani_Click(object sender, RoutedEventArgs e)
        {
            Odustani();
            this.Close();
        }

        private void BtPotvrdi_Click(object sender, RoutedEventArgs e)
        {
            if (!String.IsNullOrEmpty(txtSifra.Text) && !String.IsNullOrEmpty(txtVlasnik.Text) && !String.IsNullOrEmpty(txtKvadratura.Text) && !String.IsNullOrEmpty(cmbKatOpstine.Text) && lbParcele.SelectedValue != null) 
            {
                Objekti objekti = new Objekti()
                {
                    IDObjekta = (int.Parse)(txtSifra.Text),
                    Vlasnik=txtVlasnik.Text,
                    Kvadratura=int.Parse(txtKvadratura.Text),
                    Uknjizeno=(bool)ckUknjizeno.IsChecked,
                    IDParcele=(int.Parse)(((Parcele)lbParcele.SelectedValue).IDParcele.ToString()),
                    IDKatOpstina=(int.Parse)(((KatastarskeOpstine)cmbKatOpstine.SelectedValue).IDKatOpstina.ToString()),
                };
                katastar.Objektis.InsertOnSubmit(objekti);

                try
                {
                    katastar.SubmitChanges();
                    MessageBox.Show("Uspesno dodat novi unos", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
                    Odustani();
                }
                catch (Exception ex)
                {

                    MessageBox.Show("Nije dodas novi unos " + ex.Message);
                }
            }
            else
            {
                MessageBox.Show("Polja ne smeju biti prazna", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
            }
        }
    }
}
