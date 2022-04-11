<?php


function send_mail($oThis, $to, $subjet, $msg, $attach = null)
{
  // Konfigurasi email 
  $config = [
    'mailtype'  => 'html',
    'charset'   => 'utf-8',
    'protocol'  => 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_user' => 'codtech.info@gmail.com',  // Email gmail
    'smtp_pass'   => 'wordpress2020',  // Password gmail
    'smtp_crypto' => 'ssl',
    'smtp_port'   => 465,
    'crlf'    => "\r\n",
    'newline' => "\r\n"
  ];

  // Load library email dan konfigurasinya
  $oThis->load->library('email', $config);

  // Email dan nama pengirim
  $oThis->email->from('noreply@codtech.id', 'Codtech.id');

  // Email penerima
  $oThis->email->to($to); // Ganti dengan email tujuan

  if ($attach != null) {
    // Lampiran email, isi dengan url/path file
    $oThis->email->attach($attach);
  }

  // Subject email
  $oThis->email->subject($subjet);

  // Isi email
  $oThis->email->message($msg);

  // Tampilkan pesan sukses atau error
  if ($oThis->email->send()) {
    echo 'Sukses! email berhasil dikirim.';
  } else {
    echo 'Error! email tidak dapat dikirim.';
    echo $oThis->email->print_debugger();
  }
}

// function send_mail($oThis, $data)
// {
//   // Konfigurasi email 
//   $config = [
//     'mailtype'  => 'html',
//     'charset'   => 'utf-8',
//     'protocol'  => 'smtp',
//     'smtp_host' => 'smtp.gmail.com',
//     'smtp_user' => 'codtech.info@gmail.com',  // Email gmail
//     'smtp_pass'   => 'wordpress2020',  // Password gmail
//     'smtp_crypto' => 'ssl',
//     'smtp_port'   => 465,
//     'crlf'    => "\r\n",
//     'newline' => "\r\n"
//   ];

//   // Load library email dan konfigurasinya
//   $oThis->load->library('email', $config);

//   // Email dan nama pengirim
//   $oThis->email->from('no-reply@masrud.com', 'MasRud.com');

//   // Email penerima
//   $oThis->email->to('penerima@domain.com'); // Ganti dengan email tujuan

//   // Lampiran email, isi dengan url/path file
//   $oThis->email->attach('https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');

//   // Subject email
//   $oThis->email->subject('Kirim Email dengan SMTP Gmail CodeIgniter | MasRud.com');

//   // Isi email
//   $oThis->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/kirim-email-codeigniter/' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

//   // Tampilkan pesan sukses atau error
//   if ($oThis->email->send()) {
//     echo 'Sukses! email berhasil dikirim.';
//   } else {
//     echo 'Error! email tidak dapat dikirim.';
//   }
// }
