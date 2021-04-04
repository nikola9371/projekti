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

namespace WpfApp2
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        private ApotekaDataContext apoteka = new ApotekaDataContext();
        public MainWindow()
        {
            InitializeComponent();
        }
        private void puniGrid()
        {
            var grid = apoteka.Recepts;
            dataGrid1.ItemsSource = grid;
        }
        private void puniKombo()
        {
            var dijagnoze = apoteka.Dijagnozas;
            var brKutija = apoteka.Recepts;

            cmbDijagnoze.ItemsSource = dijagnoze;
            cmbBrKutija.ItemsSource = brKutija;
        }
        private void MenuItem_Click(object sender, RoutedEventArgs e)
        {
            Window1 window1 = new Window1();
            window1.ShowDialog();
        }

        private void DataGrid_LoadingRowDetails(object sender, DataGridRowDetailsEventArgs e)
        {
            int idRec = int.Parse(((Recept)dataGrid1.SelectedValue).ReceptID.ToString());
            var recept = apoteka.Recepts.Where(x => x.ReceptID == idRec).FirstOrDefault();

            if (recept != null)
            {
                TextBox tb1 = e.DetailsElement.FindName("txtSifraBolest") as TextBox;
                tb1.Text = recept.SifraBolesti.ToString();
                TextBox tb2 = e.DetailsElement.FindName("txtSifraLek") as TextBox;
                tb2.Text = recept.SifraLeka.ToString();
                TextBox tb3 = e.DetailsElement.FindName("txtBrKut") as TextBox;
                tb3.Text = recept.BrKutija.ToString();
                
            }
        }

        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            puniGrid();
            puniKombo();
        }

        private void DataGrid1_SelectionChanged(object sender, SelectionChangedEventArgs e)
        { 
            int idRec = int.Parse(((Recept)dataGrid1.SelectedValue).ReceptID.ToString());
            var recept = apoteka.Recepts.Where(x => x.ReceptID == idRec).FirstOrDefault();

            if (recept != null)
            {
                txtBrKut.Text = recept.BrKutija.ToString();
            }
        }

        private void BtnDijagnoza_Click(object sender, RoutedEventArgs e)
        {
            if (cmbDijagnoze.SelectedIndex > -1)
            {
                var oboljenje = int.Parse(((Dijagnoza)cmbDijagnoze.SelectedValue).SifraBolesti.ToString());
                var doza = apoteka.Terapijas.Where(x => x.SifraBolesti == oboljenje).GroupBy(x => x.Doza).First();

                lbDoza.ItemsSource = doza;
            }
            else
            {
                MessageBox.Show("Niste odabrali dijagnozu", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
            }
        }

        private void CmbBrKutija_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if (cmbDijagnoze.SelectedIndex > -1)
            {
                var id = int.Parse(((Recept)cmbBrKutija.SelectedValue).ReceptID.ToString());
                var idBolest = int.Parse(((Dijagnoza)cmbDijagnoze.SelectedValue).SifraBolesti.ToString());
                var pacijenti = apoteka.Recepts.Where(x => x.ReceptID == id&&x.SifraBolesti==idBolest);

                lbPacijenti.ItemsSource = pacijenti;
            }
            else
            {
                MessageBox.Show("Niste odabrali dijagnozu", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
            }
        }


        private void BtnNaplati_Click(object sender, RoutedEventArgs e)
        {
            if (!String.IsNullOrEmpty(txtBrKut.Text) && !String.IsNullOrEmpty(txtJedCena.Text))
            {
                txtNaplata.Text = ((int.Parse)(txtBrKut.Text) * (int.Parse)(txtJedCena.Text)).ToString();
            }
            else
            {
                MessageBox.Show("Polja su prazna", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
            }
        }

        private void BtnStorniraj_Click(object sender, RoutedEventArgs e)
        {
            if (!String.IsNullOrEmpty(txtSifraReceptStorn.Text))
            {
                int idRecept = int.Parse(txtSifraReceptStorn.Text);
                var recept = apoteka.Recepts.Where(x => x.ReceptID == idRecept).FirstOrDefault();

                MessageBoxResult message = MessageBox.Show("Da li zelite da stornirate", "Obavestenje", MessageBoxButton.YesNo, MessageBoxImage.Question);

                if (message == MessageBoxResult.Yes)
                {
                    apoteka.Recepts.DeleteOnSubmit(recept);
                    dataGrid1.ItemsSource = null;
                    puniGrid();
                    dataGrid1.Items.Refresh();

                    try
                    {
                        apoteka.SubmitChanges();
                        MessageBox.Show("Uspesno stornirano", "Objasnjenje", MessageBoxButton.OK, MessageBoxImage.Information);
                    }
                    catch(Exception ex)
                    {
                        MessageBox.Show("Nije uradjena radnja" + ex.Message);
                    }
                }


            }
            else
            {
                MessageBox.Show("Polje ne sme biti prazno", "Obavestenje", MessageBoxButton.OK, MessageBoxImage.Information);
            }
        }
    }
}
