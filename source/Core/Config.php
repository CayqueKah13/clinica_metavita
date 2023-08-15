<?php

namespace Source\Core;

class Config {
  const BASE_URL = "https://www.clinicametavita.com.br";
  const BASE_URL_ADMIN = Config::BASE_URL . "/admin";
  const BASE_URL_CUSTOMER = Config::BASE_URL . "/cliente";
  const BASE_URL_INSTRUCTOR = Config::BASE_URL . "/area-do-profissional";



  // DATABASE
  const DATABASE_NAME = "clinicametavitac_clini130_metavita";
  const DATABASE_USER = "clinicametavitac_clini130_cayque";
  const DATABASE_PASSWORD = "nk2ev_dPwxJK2VN";


  // CONTACT
  const WHATSAPP_URL = "https://api.whatsapp.com/send?phone=55";
  const WHATSAPP_NUMBER = "(11) 97375-5967";
  const WHATSAPP_MESSAGE = "Olá, estava no site de vocês e gostaria de mais informações!";


  // MAILER
  // const MAILER_OPTION_HOST = 'smtp.gmail.com';
  // const MAILER_OPTION_PORT = 587;
  // const MAILER_OPTION_SENDER_EMAIL = 'metavita.nutri@gmail.com';
  // const MAILER_OPTION_SENDER_PASSWORD = 'hrgjbiungdzuzvas';
  // const MAILER_OPTION_SENDER_NAME = 'MetaVita';
  // MAILER
  // const MAILER_OPTION_HOST = 'smtp.gmail.com';
  // const MAILER_OPTION_PORT = 587;
  // const MAILER_OPTION_SENDER_EMAIL = 'roberto@vianti.com.br';
  // const MAILER_OPTION_SENDER_PASSWORD = 'yuutioxkjxdznqab';
  // const MAILER_OPTION_SENDER_NAME = 'Vianti';

  const MAILER_SENDGRID_KEY = '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';
  const MAILER_OPTION_SENDER_EMAIL = 'noreply@clinicametavita.com.br';
  const MAILER_OPTION_SENDER_NAME = 'Clínica MetaVita';
  const MAILER_DEFAULT_LEADS_RECEIVER = '';

}
