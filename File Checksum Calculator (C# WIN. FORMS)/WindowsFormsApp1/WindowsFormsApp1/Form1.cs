using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Security.Cryptography;
using System.IO;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            radioButtonMD5.Select();
            comboBoxExtensions.SelectedIndex = 8;
            comboBoxExtensions.DropDownStyle = ComboBoxStyle.DropDownList;
        }
        //Function that allows the user to specify a directory
        private void buttonSelectFolder_Click(object sender, EventArgs e)
        {
            FolderBrowserDialog fbd = new FolderBrowserDialog();
            treeView1.Nodes.Clear();
            fbd.ShowNewFolderButton = false;

            fbd.Description = "Select a folder in order to calculate its file checksum";
            if (fbd.ShowDialog() == System.Windows.Forms.DialogResult.OK)
                directorySearch(fbd.SelectedPath);
            else
                return;
        }

        //Traverses the specified directory for files in the specified folder and subfolders( if they exist), and returns names of files found inside
        //Function also displays all files inside a treeView, and inside every node it displays additional information about every file
        private void directorySearch(string SelectedPath)
        {
            DirectoryInfo directory = new DirectoryInfo(SelectedPath);
            //string fileInfo = String.Empty;
            FileInfo[] files = directory.GetFiles(comboBoxExtensions.SelectedItem.ToString(),SearchOption.AllDirectories);
            int i = 0;

            foreach (FileInfo file in files)
            {
                treeView1.Nodes.Add(file.Name);
                treeView1.Nodes[i].Nodes.Add("File name: " + file.Name);
                treeView1.Nodes[i].Nodes.Add("File size:" + (file.Length / 1024).ToString()+" kb");
                treeView1.Nodes[i].Nodes.Add("Checksum: " + ChecksumFile(file.FullName));
                treeView1.Nodes[i].Nodes.Add("Attributes: " + file.Attributes);
                treeView1.Nodes[i].Nodes.Add("Creation date: " + file.CreationTime);

                i++;
  
             
            }

        }
        //Simple function that checks what radio button has been selected
        private string ChecksumFile(string filePath)
        {
            if (radioButtonMD5.Checked == true)
                return CalculateMD5(filePath);
            else if (radioButtonSHA1.Checked == true)
                return CalculateSHA1(filePath);
            else if (radioButtonSHA256.Checked == true)
                return CalculateSHA256(filePath);
            else if (radioButtonSHA384.Checked == true)
                return CalculateSHA384(filePath);
            else if (radioButtonSHA512.Checked == true)
                return CalculateSHA512(filePath);
            else return null;
        }
        //Function used to hash data into MD5 checksum algorithm
        //All other functions SHA1,SHA256,SHA5368,SHA512 accomplish the same thing just use a different encryption method
        private static string CalculateMD5(string filename)
        {
            using (var md5=MD5.Create())
            {
                using (var stream=File.OpenRead(filename))
                {
                    var hash = md5.ComputeHash(stream);
                    return BitConverter.ToString(hash).Replace("-", "").ToLowerInvariant();
                }
            }
        }
        private static string CalculateSHA1(string filename)
        {
            using (var sha1 = SHA1.Create())
            {
                using (var stream = File.OpenRead(filename))
                {
                    var hash = sha1.ComputeHash(stream);
                    return BitConverter.ToString(hash).Replace("-", "").ToLowerInvariant();
                }
            }
        }
        private static string CalculateSHA256(string filename)
        {
            using (var sha256 = SHA256.Create())
            {
                using (var stream = File.OpenRead(filename))
                {
                    var hash = sha256.ComputeHash(stream);
                    return BitConverter.ToString(hash).Replace("-", "").ToLowerInvariant();
                }
            }
        }
        private static string CalculateSHA384(string filename)
        {
            using (var sha384 = SHA384.Create())
            {
                using (var stream = File.OpenRead(filename))
                {
                    var hash = sha384.ComputeHash(stream);
                    return BitConverter.ToString(hash).Replace("-", "").ToLowerInvariant();
                }
            }
        }
        private static string CalculateSHA512(string filename)
        {
            using (var sha512 = SHA512.Create())
            {
                using (var stream = File.OpenRead(filename))
                {
                    var hash = sha512.ComputeHash(stream);
                    return BitConverter.ToString(hash).Replace("-", "").ToLowerInvariant();
                }
            }
        }

        private void buttonExit_Click(object sender, EventArgs e)
        {
            Close();
        }
    }
}
