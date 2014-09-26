<?php

class Registered extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
//        $this->load->helper('session');
    }

    public function index() {
        $data = array();
        $this->load->model('admin/user');
        $this->load->helper('url');
        $this->load->library('pagination');

        /* Set the config parameters */
        $config = array();
//        $config["base_url"] = base_url() . "welcome/example1";
        $config["base_url"] = SITE_URL . 'admin/registered/index';
        $config["total_rows"] = $this->user->record_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
//        echo $this->uri->segment(3) . ' ----third---';
//        echo $this->uri->segment(4) . '----forth----';
//        echo $this->uri->segment(5) . '----fifth-----';
//        die;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
//        $data["results"] = $this->Countries->
//                fetch_countries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

//        $this->load->view("example1", $data);

        $this->pagination->initialize($config);

//        echo $this->pagination->create_links();
        $data['result'] = $this->user->get_registered_user($config["per_page"], $page);
        $this->load->view('admin/registered_user', $data);
//        $this->load->view('admin/registered_user');
    }

    public function send_mail_view() {
        $this->load->view('admin/mail_view');
    }

    public function send_mail() {
        $this->load->library('email');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $cc = $this->input->post('cc');
        $bcc = $this->input->post('bcc');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $this->email->from($from, 'Your Name');
        $this->email->to($to);
        $this->email->cc($cc);
        $this->email->bcc($bcc);

        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            //TODO: load view...
            echo "email sent";
        } else {
            $to = $this->input->post('to');
            mail($to, 'test', 'Other sent option failed');
            echo $this->input->post('to');
            show_error($this->email->print_debugger());
        }
    }

    public function view_date() {
        $this->load->view('admin/test_dates');
    }

    public function calculate_date() {
        $this->load->helper('date');

        echo 'First date:' . $date1 = $this->input->post('first_date');
        echo nl2br("\n");
        echo 'Second date:' . $date2 = $this->input->post('second_date');
        echo nl2br("\n");

        $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
        $datestring = "%Y-%m-%d - %h:%i %a";
        $time = time();
        $date = mdate($datestring, $time) . '----';

//        echo $todays_date = date('d-m-Y') . '-----';
        $format = 'DATE_RFC822';
        $time = time();
        $now = time();
//        echo $this->dateoperations->sum($date);
//        echo $human = unix_to_human($now) . '---human time format---';
//        echo standard_date($format, $time) . '----';
//        echo days_in_month(05, 2014);
        $time1 = strtotime("2008-12-13 10:42:00");
        $time2 = strtotime("2010-10-20 08:10:00");
        $diff = $time2 - $time1;

        /*         * ********** substract no of months from date *********** */
//        echo $date1 = "1998-08-14";
        $newdate = strtotime('-3 month', strtotime($date1));
        $newdate = date('d-m-Y', $newdate);
        echo 'Subtracted 3 months from first date ' . $newdate;
        echo nl2br("\n");
        /*         * ********** substract no of days from date *********** */
//        $date1 = "1989-10-14";
        $newdate1 = strtotime('-3 days', strtotime($date1));
        $newdate1 = date('d-m-Y', $newdate1);
        echo 'Subtracted 3 days from first date ' . $newdate1;
        echo nl2br("\n");
        /*         * ********** add no of weeks from date *********** */
//        $date1 = "1989-09-19";
        $newdate2 = strtotime('+3 weeks', strtotime($date1));
        $newdate2 = date('d-m-Y', $newdate2);
        echo 'Added 3 weeks in first date ' . $newdate2;
        echo nl2br("\n");
        /**         * ********* substract no of days from date *********** */
//        $date1 = "1989-10-14";
        $newdate1 = strtotime('+3 days', strtotime($date1));
//        echo $days = strtotime($date1) - strtotime($newdate1) . '   --';
        echo nl2br("\n");
        /*         * ********************* calculate day month and year diff between two dates********************** */
//        $date1 = "2014-06-24";
//        $date2 = "2014-06-26";

        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        printf('Diff Between two dates in year month and days: ' . "%d years, %d months, %d days\n", $years, $months, $days);
        echo nl2br("\n");

        /*         * ************calculate time difference between two times stamps ******* */
        $timeFirst = strtotime('2011-05-12 18:20:20');
        $timeSecond = strtotime('2011-05-13 18:20:20');
        $differenceInSeconds = $timeSecond - $timeFirst;
        /*         * ************** end****************** */
        date_default_timezone_set('Asia/Kolkata');
        echo date('Y-m-d H:i:s');
        echo strtotime(time());
        echo nl2br("\n");
        $timestamp = time() + date("Z");
        echo gmdate("Y/m/d H:i:s", $timestamp);
        echo nl2br("\n");
        echo gmdate("M d Y H:i:s", mktime(0, 0, 0, 0, 0, 2014));


        echo nl2br("\n");
//        date_default_timezone_set('IST');
        echo date('h:i:s');
        echo nl2br("\n");
        echo date('h:i:s', strtotime('+5 minutes'));
        echo nl2br("\n");
        echo date('d-m-Y H:i:s');
        echo nl2br("\n");
        date_default_timezone_set('GMT');
        $curTime = strtotime("+5 hours");
//        echo $current_date = date("Y M D H:S", $curTime);
        echo nl2br("\n");
        echo date('h:i:s');
        echo nl2br("\n");
        echo date('h:i:s', strtotime('+5 hours'));
        echo nl2br("\n");
        echo date('d-m-Y H:i:s');
        //echo $last_day_of_last_month = mktime(0, 0, 0, date('n'), 0, date('Y')).'---';
    }

}
?>

