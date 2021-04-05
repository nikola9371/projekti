namespace WindowsFormsApp1
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.buttonSelectFolder = new System.Windows.Forms.Button();
            this.radioButtonMD5 = new System.Windows.Forms.RadioButton();
            this.radioButtonSHA1 = new System.Windows.Forms.RadioButton();
            this.radioButtonSHA256 = new System.Windows.Forms.RadioButton();
            this.radioButtonSHA384 = new System.Windows.Forms.RadioButton();
            this.radioButtonSHA512 = new System.Windows.Forms.RadioButton();
            this.comboBoxExtensions = new System.Windows.Forms.ComboBox();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.treeView1 = new System.Windows.Forms.TreeView();
            this.buttonExit = new System.Windows.Forms.Button();
            this.groupBox1.SuspendLayout();
            this.SuspendLayout();
            // 
            // buttonSelectFolder
            // 
            this.buttonSelectFolder.Location = new System.Drawing.Point(25, 56);
            this.buttonSelectFolder.Name = "buttonSelectFolder";
            this.buttonSelectFolder.Size = new System.Drawing.Size(278, 36);
            this.buttonSelectFolder.TabIndex = 0;
            this.buttonSelectFolder.Text = "Select folder";
            this.buttonSelectFolder.UseVisualStyleBackColor = true;
            this.buttonSelectFolder.Click += new System.EventHandler(this.buttonSelectFolder_Click);
            // 
            // radioButtonMD5
            // 
            this.radioButtonMD5.AutoSize = true;
            this.radioButtonMD5.Location = new System.Drawing.Point(6, 21);
            this.radioButtonMD5.Name = "radioButtonMD5";
            this.radioButtonMD5.Size = new System.Drawing.Size(58, 21);
            this.radioButtonMD5.TabIndex = 1;
            this.radioButtonMD5.TabStop = true;
            this.radioButtonMD5.Text = "MD5";
            this.radioButtonMD5.UseVisualStyleBackColor = true;
            // 
            // radioButtonSHA1
            // 
            this.radioButtonSHA1.AutoSize = true;
            this.radioButtonSHA1.Location = new System.Drawing.Point(6, 48);
            this.radioButtonSHA1.Name = "radioButtonSHA1";
            this.radioButtonSHA1.Size = new System.Drawing.Size(65, 21);
            this.radioButtonSHA1.TabIndex = 2;
            this.radioButtonSHA1.TabStop = true;
            this.radioButtonSHA1.Text = "SHA1";
            this.radioButtonSHA1.UseVisualStyleBackColor = true;
            // 
            // radioButtonSHA256
            // 
            this.radioButtonSHA256.AutoSize = true;
            this.radioButtonSHA256.Location = new System.Drawing.Point(6, 75);
            this.radioButtonSHA256.Name = "radioButtonSHA256";
            this.radioButtonSHA256.Size = new System.Drawing.Size(81, 21);
            this.radioButtonSHA256.TabIndex = 3;
            this.radioButtonSHA256.TabStop = true;
            this.radioButtonSHA256.Text = "SHA256";
            this.radioButtonSHA256.UseVisualStyleBackColor = true;
            // 
            // radioButtonSHA384
            // 
            this.radioButtonSHA384.AutoSize = true;
            this.radioButtonSHA384.Location = new System.Drawing.Point(6, 102);
            this.radioButtonSHA384.Name = "radioButtonSHA384";
            this.radioButtonSHA384.Size = new System.Drawing.Size(81, 21);
            this.radioButtonSHA384.TabIndex = 4;
            this.radioButtonSHA384.TabStop = true;
            this.radioButtonSHA384.Text = "SHA384";
            this.radioButtonSHA384.UseVisualStyleBackColor = true;
            // 
            // radioButtonSHA512
            // 
            this.radioButtonSHA512.AutoSize = true;
            this.radioButtonSHA512.Location = new System.Drawing.Point(6, 129);
            this.radioButtonSHA512.Name = "radioButtonSHA512";
            this.radioButtonSHA512.Size = new System.Drawing.Size(81, 21);
            this.radioButtonSHA512.TabIndex = 5;
            this.radioButtonSHA512.TabStop = true;
            this.radioButtonSHA512.Text = "SHA512";
            this.radioButtonSHA512.UseVisualStyleBackColor = true;
            // 
            // comboBoxExtensions
            // 
            this.comboBoxExtensions.FormattingEnabled = true;
            this.comboBoxExtensions.Items.AddRange(new object[] {
            "*.jpeg",
            "*.jpg",
            "*.png",
            "*.txt",
            "*.doc",
            "*.docx",
            "*.tar",
            "*.zip",
            "*"});
            this.comboBoxExtensions.Location = new System.Drawing.Point(336, 238);
            this.comboBoxExtensions.Name = "comboBoxExtensions";
            this.comboBoxExtensions.Size = new System.Drawing.Size(200, 24);
            this.comboBoxExtensions.TabIndex = 6;
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.radioButtonMD5);
            this.groupBox1.Controls.Add(this.radioButtonSHA1);
            this.groupBox1.Controls.Add(this.radioButtonSHA512);
            this.groupBox1.Controls.Add(this.radioButtonSHA256);
            this.groupBox1.Controls.Add(this.radioButtonSHA384);
            this.groupBox1.Location = new System.Drawing.Point(336, 50);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(200, 162);
            this.groupBox1.TabIndex = 7;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Checksum algorithm";
            // 
            // treeView1
            // 
            this.treeView1.Location = new System.Drawing.Point(25, 238);
            this.treeView1.Name = "treeView1";
            this.treeView1.Size = new System.Drawing.Size(278, 262);
            this.treeView1.TabIndex = 8;
            // 
            // buttonExit
            // 
            this.buttonExit.Location = new System.Drawing.Point(342, 449);
            this.buttonExit.Name = "buttonExit";
            this.buttonExit.Size = new System.Drawing.Size(194, 51);
            this.buttonExit.TabIndex = 9;
            this.buttonExit.Text = "Exit";
            this.buttonExit.UseVisualStyleBackColor = true;
            this.buttonExit.Click += new System.EventHandler(this.buttonExit_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(582, 553);
            this.Controls.Add(this.buttonExit);
            this.Controls.Add(this.treeView1);
            this.Controls.Add(this.groupBox1);
            this.Controls.Add(this.comboBoxExtensions);
            this.Controls.Add(this.buttonSelectFolder);
            this.Name = "Form1";
            this.Text = "Form1";
            this.Load += new System.EventHandler(this.Form1_Load);
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion
        private System.Windows.Forms.Button buttonSelectFolder;
        private System.Windows.Forms.RadioButton radioButtonMD5;
        private System.Windows.Forms.RadioButton radioButtonSHA1;
        private System.Windows.Forms.RadioButton radioButtonSHA256;
        private System.Windows.Forms.RadioButton radioButtonSHA384;
        private System.Windows.Forms.RadioButton radioButtonSHA512;
        private System.Windows.Forms.ComboBox comboBoxExtensions;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.TreeView treeView1;
        private System.Windows.Forms.Button buttonExit;
    }
}

