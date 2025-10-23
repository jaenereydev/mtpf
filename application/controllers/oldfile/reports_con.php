<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports_con extends MY_Controller
{
	var $com = '', 
	$user = '',
	$datasets = [ [
				'fillColor' => "rgba(220,220,220,0.5)",
                'strokeColor' => "rgba(220,220,220,0.8)",
                'highlightFill' => "rgba(220,220,220,0.75)",
                'highlightStroke' => "rgba(220,220,220,1)",
			], [
				'fillColor' => "rgba(151,187,205,0.5)",
            	'strokeColor' => "rgba(151,187,205,0.8)",
            	'highlightFill' => "rgba(151,187,205,0.75)",
            	'highlightStroke' => "rgba(151,187,205,1)",
			], [
				'fillColor' => "rgba(212,161,144,0.5)",
            	'strokeColor' => "rgba(212,161,144,0.8)",
            	'highlightFill' => "rgba(212,161,144,0.75)",
            	'highlightStroke' => "rgba(212,161,144,1)",
			], [
				'fillColor' => "rgba(161,212,144,0.5)",
            	'strokeColor' => "rgba(161,212,144,0.8)",
            	'highlightFill' => "rgba(161,212,144,0.75)",
            	'highlightStroke' => "rgba(161,212,144,1)",
			] ];

	public function __construct() 
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('company_model');
        $this->load->model('loan_model');

        $this->com = $this->company_model->get_companyinfo();
        $this->user = $this->user_model->get_users($this->session->userdata('u_no'));

        $this->data = [
        		'users' => $this->user,
        		'hidebtn' => 0,
        		'com' => $this->com
        	];

        if(!$this->session->userdata('u_no')) {
          $this->logout();
        }
    }

    public function index()
    {
      	$this->data['tabs'] = 
      	[
            ['icon' => 'calendar', 'href' => 'TransactionTab', 'text' => 'Transactions', 'tab' => 
                [
                    ['id' => 'SR', 'href' => 'reports_con/transaction/summary']                                                                       
                ]
            ],
            ['icon' => 'heart-empty', 'href' => 'CustomerTab', 'text' => 'Customer', 'tab' => 
                [
                    ['id' => 'SR', 'href' => 'reports_con/customer/summary']
                ]
            ],
            ['icon' => 'list-alt', 'href' => 'InventoryTab', 'text' => 'Inventory', 'tab' => 
                [
                    ['id' => 'SR1', 'href' => 'productinventory_con', 'text' => 'Product Sales Inventory Report'],
                    ['id' => 'SR2', 'href' => 'dailyinventory_con', 'text' => 'Daily Inventory' ],
                    ['id' => 'SR3', 'href' => 'inventoryreport_con', 'text' => 'Inventory Cost' ]
                ]
            ],	
            ['icon' => 'shopping-cart', 'href' => 'SalesTab', 'text' => 'Sales', 'tab' => 
                [
                    ['id' => 'SR', 'href' => 'reports_con/sales/summary' ],
                    ['id' => 'GR', 'href' => 'reports_con/sales/graphical' ],
                    ['id' => 'GR', 'href' => 'reports_con/sales/graphical/product', 'text' => 'Sales per Product Graphical Report'],
                    ['id' => 'GR2', 'href' => 'productsales_con', 'text' => 'Product Sales Report']
                ]
            ],
            ['icon' => 'minus', 'href' => 'ExpensesTab', 'text' => 'Expenses', 'tab' => 
                [
                    ['id' => 'SR', 'href' => 'reports_con/expenses/summary' ],
                    ['id' => 'GR', 'href' => 'reports_con/expenses/graphical' ]
                ]
            ],
            ['icon' => 'credit-card', 'href' => 'CreditTab', 'text' => 'Receivings', 'tab' => 
                [
                    ['id' => 'SR', 'href' => 'reports_con/credit/summary'],
                    ['id' => 'SR1', 'href' => 'Creditpayment_con', 'text' => 'Credit Payment Report']
                ]
            ],
            ['icon' => 'minus-sign', 'href' => 'AccountPayableTab', 'text' => 'Account Payable', 'tab' => 
                [
                    ['id' => 'SR1', 'href' => 'accoutpayable_con', 'text' => 'Receiving Report' ],
                    ['id' => 'SR2', 'href' => 'accoutpayable_con', 'text' => 'Account Payable Report' ]
                ]
            ],
            ['icon' => 'usd', 'href' => 'profitAndLossTab', 'text' => 'Profit and Loss', 'tab' => 
                [
                    ['id' => 'SR', 'href' => 'reports_con/profit_and_loss/summary'],
                    ['id' => 'GR', 'href' => 'reports_con/profit_and_loss/graphical']
                ]
            ],	
            ['icon' => 'grain', 'href' => 'PoultryTab', 'text' => 'Poultry', 'separate' => true, 'tab' => 
                [
                    ['id' => 'SR1', 'href' => 'reports_con/production/summary', 'text' => 'Production Summary Report', 'position' => 'start'],
                    ['id' => 'GR', 'href' => 'reports_con/production/graphical', 'text' => 'Production Graphical Report', 'position' => 'end'],
                    ['id' => 'SR2', 'href' => 'reports_con/consumption/summary', 'text' => 'Consumption Summary Report', 'position' => 'start'],
                    ['id' => 'SR3', 'href' => 'reports_con/consumption/summary/building', 'text' => 'Consumption per Building Report'],
                    ['id' => 'GR', 'href' => 'reports_con/consumption/graphical', 'text' => 'Consumption Graphical Report', 'position' => 'end'],
                    ['id' => 'SR4', 'href' => 'reports_con/classifying/summary', 'text' => 'Classifying Summary Report', 'position' => 'start'],
                    ['id' => 'GR', 'href' => 'reports_con/classifying/graphical', 'text' => 'Classifying Graphical Report', 'position' => 'end']
                ]
            ],	
            ['icon' => 'floppy-disk', 'href' => 'ZReadingTab', 'text' => 'Z-Reading', 'tab' => 
                [
                    ['id' => 'SR', 'href' => 'reports_con/ZReading/summary']
                ]
            ],	
        ];

        $this->session->unset_userdata('print_result');

  	 $this->render_html('sidebar/reports/report_view');
    }
 
    public function sales($id, $product = false)
    {
        $this->load->model('order_model');
        $this->load->model('creditorder_model');
        if(!$this->input->get()){
            if($this->session->userdata('print_result'))
                $data = $this->session->userdata('print_result')[1];
            else
                $data = ['from' => date('m/d/Y', strtotime('-14 days')), 'to' => date('m/d/Y')];
        } else
            $data = $this->input->get();

        $date = $this->dateFormat($data);
        $this->data['input'] = $data;

        if($id == 'summary'){
            $this->data['result'] = $this->order_model->sales_report_summary($date);
            $this->data['sum'] = [
                    'cash' => $this->order_model->getSales($date) + $this->creditorder_model->creditPaid($date),
                    'credit' => $this->creditorder_model->getCredit($date),
                    'check' => $this->order_model->getSales($date, 'CHECK')
            ];

            $this->data['total'] = array_sum(array_column($this->data['result'], 'totalamount'));
            $this->session->set_userdata('print_result', array($this->data['result'], $this->data['input']) );

            $this->render_html('sidebar/reports/summary/report_sales_view');

        } elseif ($id == 'graphical') {
            if($product) {

                $this->load->model('product_model');
                $this->load->model('category_model');

                $this->data['category'] = $this->category_model->get_catactive();
                $product = $this->product_model->get_productactivebycat((isset($data['category']) ? $data['category'] : false), true);
                $result = $this->order_model->getSalesPerProductGraph($date, (isset($data['category']) && $data['category'] != '' ? $data['category'] : false));

                $labels = array_values(array_column($product, 'longdesc'));
                $bar = array_fill(0, sizeof($labels), 0);

                foreach ($result as $key => $value) {
                    $bar[array_search($value['longdesc'], $labels)] = round($value['totalamount'], 2);
                }

                $this->data['result'] = [
                    'labels' => $labels,
                    'datasets' => [ [
                        'label' => 'Amount',
                        'data' => $bar,
                        'fillColor' => $this->datasets[0]['fillColor'],
                        'strokeColor' => $this->datasets[0]['strokeColor'],
                        'highlightFill' => $this->datasets[0]['highlightFill'],
                        'highlightStroke' => $this->datasets[0]['highlightStroke']
                        ] ]
                ];

                $this->render_html('sidebar/reports/graphical/report_salesPerProduct_view', false);
            } else {
                $format = [
                        'DAY' => "DATE_FORMAT(date, '%b. %d, %Y') as DAY", 
                        'WEEK' => "CONCAT(CASE
                                WHEN adddate(date, INTERVAL 2-DAYOFWEEK(date) DAY) < '" . $date['from'] ."'
                                  THEN DATE_FORMAT(' " . $date['from'] . "', '%b. %d -')
                                ELSE DATE_FORMAT(adddate(date, INTERVAL 2-DAYOFWEEK(date) DAY), '%b. %d -')
                          END, '',
                          CASE
                                WHEN adddate(date, INTERVAL 8-DAYOFWEEK(date) DAY) > '" .  $date['to'] . "'
                                 THEN DATE_FORMAT(' " . $date['to'] . "', '%b. %d, %Y')
                                 ELSE DATE_FORMAT(adddate(date, INTERVAL 8-DAYOFWEEK(date) DAY), '%b. %d, %Y')
                          END) as WEEK",
                        'MONTH' => "DATE_FORMAT(date, '%M') as MONTH"
                        ];

                $this->load->model('order_model');
                $this->load->model('creditorder_model');

                $index = $this->dateDiff($date);
                $cash = $this->order_model->getSalesGraph($date, $format, $index);
                $credit = $this->creditorder_model->getSalesGraph($date, $format, $index);
                $result = array_merge($cash, $credit);
                $legend = ['Cash', 'Credit'];
                $labels = [];
                $bar = [];

                foreach ($result as $key => $value) {
                        if(!is_int(array_search($value[$index], $labels)))
                            $labels[] = $value[$index];
                }	

                usort($labels, function($date_1, $date_2) {
                   return strtotime($date_1) - strtotime($date_2); 
                });

                for ($i=0; $i < 2; $i++) { 
                    $bar[] = array_fill(0, sizeof($labels), 0);
                }

                foreach ($result as $key => $value) {
                    $bar[array_search($value['type'], $legend)][array_search($value[$index], $labels)] = $value['totalamount'];
                }

                $this->data['sum'] = [$ca = array_sum(array_column($cash, 'totalamount')), $ce = array_sum(array_column($credit, 'totalamount')), $ca + $ce];
                $this->data['result']['labels'] = $labels;
                foreach ($legend as $key => $value) {
                    $this->data['result']['datasets'][$key] = [
                                        'label' => $legend[$key],
                                        'data' => $bar[$key],
                                        'fillColor' => $this->datasets[$key]['fillColor'],
                                        'strokeColor' => $this->datasets[$key]['strokeColor'],
                                        'highlightFill' => $this->datasets[$key]['highlightFill'],
                                        'highlightStroke' => $this->datasets[$key]['highlightStroke']
                                        ];
                }

                $this->render_html('sidebar/reports/graphical/report_sales_view');
            }
        }
    }
          
    public function expenses($id)
    {
        $this->load->model('expenses_model');

        if(!$this->input->get()){
          if($this->session->userdata('print_result'))
            $data = $this->session->userdata('print_result')[1];
          else
            $data = ['from' => date('m/d/Y', strtotime('-14 days')), 'to' => date('m/d/Y')];
        } else
            $data = $this->input->get();

        $date = $this->dateFormat($data);
        $this->data['input'] = $data;

     	if($id == 'summary') {

            $this->data['result'] = $this->expenses_model->expenses_report_summary($date);			
            $this->data['total'] = [
                $this->expenses_model->getExpenseByType('Internal', $date),
                $this->expenses_model->getExpenseByType('External', $date),
                array_sum(array_column($this->data['result'], 'amount'))
             ];

            $this->session->set_userdata('print_result', array($this->data['result'], $this->data['input']) );
            $this->render_html('sidebar/reports/summary/report_expenses_view');

        } elseif($id == 'graphical'){
            $format = [
                    'DAY' => "DATE_FORMAT(date, '%b. %d, %Y') as DAY", 
                    'WEEK' => "CONCAT(CASE
                        WHEN adddate(date, INTERVAL 2-DAYOFWEEK(date) DAY) < '" . $date['from'] ."'
                          THEN DATE_FORMAT('" . $date['from'] . "', '%b. %d - ')
                        ELSE DATE_FORMAT(adddate(date, INTERVAL 2-DAYOFWEEK(date) DAY), '%b. %d - ')
                  END, '',
                  CASE
                        WHEN adddate(date, INTERVAL 8-DAYOFWEEK(date) DAY) > '" .  $date['to'] . "'
                         THEN DATE_FORMAT('" . $date['to'] . "', '%b. %d, %Y')
                         ELSE DATE_FORMAT(adddate(date, INTERVAL 8-DAYOFWEEK(date) DAY), '%b. %d, %Y')
                  END) as WEEK",
                    'MONTH' => "DATE_FORMAT(date, '%M') as MONTH"
                    ];

	    	$dif = date_diff(date_create($date['from']), date_create($date['to']))->format('%a');

	    	switch ($dif) {
	    		case $dif <= 14:
	    			$index = 'DAY';
	    			break;
	    		case $dif > 14 && $dif <= 120:
	    			$index = 'WEEK';
	    			break;
	    		case $dif > 120: 
	    			$index = 'MONTH';
	    	}

	    	$result = $this->expenses_model->expenseReportGraph($date, $format, $index);
	    	$legend = array_values(array_unique(array_column($result, 'type')));
	    	$labels = [];
	    	$bar = [];

	    	foreach ($result as $key => $value) {
	    		if(!is_int(array_search($value[$index], $labels)))
	    			$labels[] = $value[$index];
	    	}

	    	foreach ($legend as $key => $value) {
	    		$bar[] = array_fill(0, sizeof($labels), 0);
	    		$this->data['sum'][$value] = 'P ' . number_format($this->expenses_model->getExpenseByType($value, $date)[0]->total, 2);
	    	}

	    	foreach ($result as $key => $value) {
	    		$bar[array_search($value['type'], $legend)][array_search($value[$index], $labels)] = $value['amount'];
	    	}

	    	$this->data['result']['labels'] = $labels;

	    	foreach ($legend as $key => $value) {
	    		$this->data['result']['datasets'][$key] = [
    				'label' => $legend[$key],
    				'data' => $bar[$key],
    				'fillColor' => $this->datasets[$key]['fillColor'],
            'strokeColor' => $this->datasets[$key]['strokeColor'],
            'highlightFill' => $this->datasets[$key]['highlightFill'],
            'highlightStroke' => $this->datasets[$key]['highlightStroke']
	    		];
	    	}
	    
	      $this->render_html('sidebar/reports/graphical/report_expenses_view');
	    }
    }

	  public function credit($id)
	  {
	  	$this->load->model('creditorder_model');
			if($this->input->get()){
				$data = $this->input->get();
				$date = $this->dateFormat($data);
				$this->data['input'] = $data;
			} else if($this->session->userdata('print_result')) {
				$data = $this->session->userdata('print_result')[1];
			}

			$this->data['result'] = $this->creditorder_model->credit_report(isset($date) ? $date : false);
			$this->data['total'] = array_sum(array_column($this->data['result'][0], 'totalamount')) + (isset($this->data['result'][1][0]->paid) ? $this->data['result'][1][0]->paid : 0);

			$this->session->set_userdata('print_result', array($this->data['result'][0], (isset($this->data['input']) ? $this->data['input'] : false ) ) );

			if($id == 'summary')
	  		$this->render_html('sidebar/reports/summary/report_credit_view');
	  	else
	  		$this->render_html('sidebar/reports/graphical/report_credit_view');
	  }

	  public function profit_and_loss($id)
	  {
	  	$this->load->model('creditorder_model');
	  	$this->load->model('product_model');
	  	$this->load->model('expenses_model');
	  	$this->load->model('order_model');
	  	
			if(!$this->input->get())
				$data = ['from' => date('m/d/Y'), 'to' => date('m/d/Y')];
			else
				$data = $this->input->get();

			$date = $this->dateFormat($data);
			$this->data['input'] = $data;

			if($id == 'summary'){
				
				$profit = $this->product_model->get_profitByDate($date);
				$expense = $this->expenses_model->getExpenseByDate($date);
				$sales = $this->order_model->getSales($date, false);
				$discount = $this->order_model->getDiscountByDate($date);
				$additional = $this->order_model->getAdditionalPaymentByDate($date);
				$cost = $this->order_model->getCostOfGoods($date);
				$return = $this->order_model->getReturnItem($date);
				$paid = $this->creditorder_model->creditPaid($date);
				$receive = $this->creditorder_model->getCredit($date);

				$this->data['result'] = [
					'profit' => 'P ' . number_format($profit, 2),
					'sales' => 'P ' . number_format($sales - $additional + $paid + $discount, 2),
					'discounts' => 'P ' . number_format(-$discount, 2),
					'additional' => 'P ' . number_format(-$additional, 2),
					'returnItem' => 'P ' . number_format($return, 2),
					'receiving' => 'P ' . number_format($receive, 2),
					'cost' => 'P ' . number_format(-$cost, 2),
					'total' => 'P ' . number_format($sales + $paid + $receive + $return, 2)
					];
			

		  	$this->render_html('sidebar/reports/summary/report_profit_and_loss_view');
			} else if($id == 'graphical'){
	  		$this->render_html('sidebar/reports/graphical/report_profit_and_loss_view');
			}
	  }

	  public function customer($id)
	  {
	  	$this->load->model('customer_model');
	  	$this->load->model('creditorder_model');
	  	$this->load->model('customer_model');
	  	$this->load->model('order_model');
	  	
	  	if(!$this->input->get()){
	  		if($this->session->userdata('print_result'))
	  			$data = $this->session->userdata('print_result')[1];
	  		else
					$data = ['from' => date('m/d/Y'), 'to' => date('m/d/Y')];
	  	} else
				$data = $this->input->get();
			
			$date = $this->dateFormat($data);

			$this->data['result'] = $this->customer_model->report_customer($date);
			$paid = $this->creditorder_model->creditPaid($date) + $this->order_model->getSales($date, false);
			$unpaid = (double) $this->creditorder_model->getCredit($date);
			// $credit = $this->creditorder_model->getAllCredit($date);

			$this->data['sum'] = [
				'unpaid' => $unpaid,
				'customer' => array_sum(array_column($this->customer_model->getUnpaidCUstomer($date), 'count')),
				'paid' => $paid,
				'total' => $paid + $unpaid
			];
			
			$this->data['input'] = $data;

			$this->session->set_userdata('print_result', array($this->data['result'], $this->data['input']) );

	  	if($id == 'summary')
		  	$this->render_html('sidebar/reports/summary/report_customer_view');
	  	else
	  		$this->render_html('sidebar/reports/graphical/report_customer_view');
	  }

        public function sales_and_expense_report($u_no = false, $date = false)
        {
            $this->load->model('Zreading_model');
            $this->load->model('expenses_model');
            $this->load->model('order_model');
            $this->load->model('Banktransaction_model');
            $this->load->model('creditorder_model');
            $this->load->model('checkref_model');            

            $result = $this->Zreading_model->getZReading($date, $u_no);

            $coins = [0, 0];
            $search = ['twenty_five_cents' => .25, 'one' => 1, 'five' => 5, 'ten' => 10];

            foreach ($search as $key => $value) {
              if(isset($result[0]->$key)){
                $coins = [$coins[0] + $result[0]->$key, $coins[1] + ($result[0]->$key * $value)];
              }
            }
            $this->data['zno'] = $this->Zreading_model->getzno($date, $u_no);
            $this->data['check'] = $this->order_model->getCheckList($date, $u_no);
            $this->data['creditPayment'] = $this->creditorder_model->creditPaid($date, false, $u_no);
            $this->data['receipt'] = $this->order_model->salesReceipt($date, $u_no);
            $this->data['expenses'] = $this->expenses_model->getExpensesByUserId($date, $u_no);
            $this->data['internal'] = $this->expenses_model->getExpenseByType('Internal', $date, $u_no);
            $this->data['external'] = $this->expenses_model->getExpenseByType('External', $date, $u_no);
            $this->data['actual'] = $this->order_model->salesToday(($u_no ? $u_no : $this->session->userdata('u_no')), $date);
            $this->data['payments'] = $this->checkref_model->getPaymentList($date, $u_no);
            $this->data['paymentSum'] = [$this->creditorder_model->getTodayCheckPayment($date, $u_no), $this->checkref_model->getTodaySum($date, $u_no)];
            $this->data['result'] = $result;
            $this->data['result'][0]->coins = $coins;
            $this->data['input'] = $date;
            $this->data['payments2'] = $this->checkref_model->getPaymentList2($date, $u_no);
            $this->data['zreading'] = $this->order_model->sumsalesorders($date, $u_no);
            $this->data['cpayment'] = $this->order_model->creditpayment($date, $u_no);
            $this->data['sumcash'] = $this->order_model->sumcash($date, $u_no);
            $this->data['sumcheck'] = $this->order_model->sumcheck($date, $u_no);
            $this->data['creditsales'] = $this->order_model->creditsales($date, $u_no);
            $this->data['sumcreditsales'] = $this->order_model->sumcreditsales($date, $u_no);
            $this->data['bankdeposit'] = $this->Banktransaction_model->sumdeposit($date, $u_no);
            $this->data['checkonhand'] = $this->order_model->checkonhand($date, $u_no);
            $this->data['loan'] = $this->loan_model->get_loanreport($date, $u_no);
            
            $this->render_html('sidebar/reports/sales_and_expense', false);
        }

        public function deltransaction($no, $type)
        {
            $this->load->model('creditorder_model');
            $this->load->model('order_model');
            $this->order_model->deltrans($no);
          
            redirect('reports_con/transaction/summary');
        }
                
	  public function transaction($id)
	  {
	  	$this->load->model('order_model');
	  	$this->load->model('creditorder_model');

	  	if(!$this->input->get()){
	  		if($this->session->userdata('print_result'))
	  			$data = $this->session->userdata('print_result')[1];
	  		else
					$data = ['from' => date('m/d/Y'), 'to' => date('m/d/Y')];
	  	}
			else
				$data = $this->input->get();
			
			$date = $this->dateFormat($data);
			
	  	$this->data['result'] = $this->order_model->getAllTransactionByDate($date);
                $this->data['input'] = $data;

                $this->session->set_userdata('print_result', array($this->data['result'], $this->data['input']) );

	  	$this->render_html('sidebar/reports/summary/report_transaction_view');
	  }

	  public function inventory($id)
	  {
	  	$this->load->model('inventory_model');
	  }

	  public function production($id)
	  {
	  	$this->load->model('production_model');

	  	if(!$this->input->get()){
	  		if($this->session->userdata('print_result'))
	  			$data = $this->session->userdata('print_result')[1];
	  		else
					$data = ['from' => date('m/d/Y', strtotime('-14 days')), 'to' => date('m/d/Y')];
	  	} else
				$data = $this->input->get();
			$date = $this->dateFormat($data);
			$this->data['input'] = $data;

			if($id == 'summary'){
			  $this->data['result']	= $this->production_model->get_list($date);
			  $this->data['input'] = $data;

				$this->session->set_userdata('print_result', array($this->data['result'], $this->data['input']) );
	  		$this->render_html('sidebar/reports/summary/report_production_view');

			} elseif($id == 'graphical'){
				$this->load->model('building_model');
				$building = $this->building_model->get_buildingByType((isset($data['type']) && $data['type'] != '' ? $data['type'] : false), true);
				$result = $this->production_model->report_graph($date, (isset($data['type']) && $data['type'] != '' ? $data['type'] : false));
				
				$this->data['type'] = $this->building_model->getType();

				$labels = array_values(array_column($building, 'building_no'));
				$bar = array_fill(0, sizeof($labels), 0);

				foreach ($result as $key => $value) {
					$bar[array_search($value->building_no, $labels)] = round($value->total);
				}

					$this->data['result'] = [
		    			'labels' => $labels,
		    			'datasets' => [ [
		    					'label' => 'Amount',
			    				'data' => $bar,
			    				'fillColor' => $this->datasets[0]['fillColor'],
			            'strokeColor' => $this->datasets[0]['strokeColor'],
			            'highlightFill' => $this->datasets[0]['highlightFill'],
			            'highlightStroke' => $this->datasets[0]['highlightStroke']
		    				] ]
		    		];
	  		$this->render_html('sidebar/reports/graphical/report_production_view', false);
			}
	  }

	  public function consumption($id, $building = false)
	  {
	  	$this->load->model('consumption_model');

	  	if(!$this->input->get()){
	  		if($this->session->userdata('print_result'))
	  			$data = $this->session->userdata('print_result')[1];
	  		else
					$data = ['from' => date('m/d/Y', strtotime('-14 days')), 'to' => date('m/d/Y')];
	  	}
			else
				$data = $this->input->get();
			$date = $this->dateFormat($data);
		  $this->data['input'] = $data;

		  if($id == 'summary'){
		  	if($building) {
		  		$this->load->model('building_model');

		  		$building = $this->building_model->get_buildingByType((isset($data['type']) && $data['type'] != '' ? $data['type'] : false), true);
		  		$result = $this->consumption_model->getConsumpByBldg($date, (isset($data['type']) && $data['type'] != '' ? $data['type'] : false));
		  		$building_no = array_column($building, 'building_no');

		  		foreach ($result as $key => $value) {
		  			$index = array_search($value->building_no, $building_no);
		  			
		  			if(is_int($index)){
		  				$building[$index]['totalamount'] = $value->totalamount;
		  				$building[$index]['totalqty'] = $value->totalqty;
		  			}
		  		}

		  		$this->data['type'] = $this->building_model->getType();
		  		$this->data['result'] = $building;
					$this->session->set_userdata('print_result', array($this->data['result'], $this->data['input']) );

			  	$this->render_html('sidebar/reports/summary/report_consumption_building_view');
		  	} else {
				  $this->data['result']	= $this->consumption_model->getList($date);
					$this->session->set_userdata('print_result', array($this->data['result'], $this->data['input']) );
					
			  	$this->render_html('sidebar/reports/summary/report_consumption_view');
		  	}

		  } else if($id == 'graphical') {
		  	$this->load->model('building_model');

		  	$building = $this->building_model->get_buildingByType((isset($data['type']) && $data['type'] != '' ? $data['type'] : false), true);
		  	$result = $this->consumption_model->getConsumpByBldg($date, (isset($data['type']) && $data['type'] != '' ? $data['type'] : false));
		  	$labels = array_column($building, 'building_no');
		  	$bar = array_fill(0, sizeof($labels), 0);
		  	$this->data['sum'] = 0;

		  	foreach ($result as $key => $value) {
		  		$totalamount = round($value->totalamount, 2);
		  		$bar[array_search($value->building_no, $labels)] = $totalamount;
		  		$this->data['sum'] += $totalamount;
		  	}

		  	$this->data['type'] = $this->building_model->getType();
		  	$this->data['result'] = [
	    			'labels' => $labels,
	    			'datasets' => [ [
	    					'label' => 'Amount',
		    				'data' => $bar,
		    				'fillColor' => $this->datasets[0]['fillColor'],
		            'strokeColor' => $this->datasets[0]['strokeColor'],
		            'highlightFill' => $this->datasets[0]['highlightFill'],
		            'highlightStroke' => $this->datasets[0]['highlightStroke']
	    				] ]
	    		];

		  	$this->render_html('sidebar/reports/graphical/report_consumption_view', false);
		  }
	  }

	  public function classifying($id)
	  {
	  	$this->load->model('classifying_model');
	  	$this->load->model('product_model');

	  	if(!$this->input->get()){
	  		if($this->session->userdata('print_result'))
	  			$data = $this->session->userdata('print_result')[1];
	  		else
					$data = ['from' => date('m/d/Y', strtotime('-14 days')), 'to' => date('m/d/Y')];
	  	}
			else
				$data = $this->input->get();
			$date = $this->dateFormat($data);
			$this->data['input'] = $data;

			if($id == 'summary'){
			  $this->data['result']	= $this->classifying_model->report_classifyline($date);
				$this->session->set_userdata('print_result', array($this->data['result'], $this->data['input']) );

		  	$this->render_html('sidebar/reports/summary/report_classifying_view');
			} else if($id == 'graphical') {
				$this->load->model('category_model');
				$this->load->model('product_model');

		  	$result = $this->classifying_model->reportClassifyGraph($date, (isset($data['category']) && $data['category'] != '' ? $data['category'] : false));


		  	$product = $this->product_model->get_selfProduction((isset($data['category']) && $data['category'] != '' ? $data['category'] : false), true);
				$this->data['category'] = $this->category_model->get_catactive();
				$labels = array_values(array_column($product, 'longdesc'));
				$bar = array_fill(0, sizeof($labels), 0);
				$this->data['sum'] = 0;

				foreach ($result as $key => $value) {
					$bar[array_search($value->longdesc, $labels)] = $value->qty;
					$this->data['sum'] += $value->qty;
				}

				$this->data['result'] = [
    			'labels' => $labels,
    			'datasets' => [ [
    					'label' => 'Quantity',
	    				'data' => $bar,
	    				'fillColor' => $this->datasets[1]['fillColor'],
	            'strokeColor' => $this->datasets[1]['strokeColor'],
	            'highlightFill' => $this->datasets[1]['highlightFill'],
	            'highlightStroke' => $this->datasets[1]['highlightStroke']
    				] ]
    		];

		  	$this->render_html('sidebar/reports/graphical/report_classifying_view', false);
			}
	  }

	  public function ZReading($id)
	  {
	  	if(!$this->input->get())
	  		if($this->session->userdata('print_result'))
	  			$data = $this->session->userdata('print_result')[1];
	  		else
					$data = ['from' => date('m/d/Y'), 'to' => date('m/d/Y')];
			else {
				$data = $this->input->get();
				$data['to'] = $data['from'];
			}

			$date = $this->dateFormat($data);

      $this->load->model('expenses_model');
	  	$this->load->model('Zreading_model');
	  	$this->load->model('creditorder_model');

      $creditPayment = $this->creditorder_model->creditPaid($date, true);

      $internal = $this->expenses_model->getExpenseByType('Internal', $date);
      $external = $this->expenses_model->getExpenseByType('External', $date);
      $result = $this->Zreading_model->getZReading($date);

      foreach ($result as $index => $outer) {
      	foreach ($internal as $key => $inner) {
      		if($outer->date == $inner->date && $outer->u_no == $inner->user){
      			$result[$index]->internal = $inner->total;
      		}
      	}

      	foreach ($external as $key => $inner) {
      		if($outer->date == $inner->date && $outer->u_no == $inner->user)
      			$result[$index]->external = $inner->total;
      	}

      	foreach ($creditPayment as $key => $inner) {
      		if($outer->date == $inner->date && $outer->u_no == $inner->u_no)
      			$result[$index]->credit = $inner->total;
      	}
      }

      $this->data['result'] = $result;
      $this->data['input'] = [$data, $date];

			$this->session->set_userdata('print_result', array($this->data['result'], $this->data['input'][0]) );

	  	$this->render_html('sidebar/reports/summary/report_z_reading_view');
	  }

	  public function getTransactionDetails()
	  {
      if($this->input->is_ajax_request()){

      	$input = explode('_', $this->input->post('info'));
      	$input[1] = $input[1] . '_model';

      	$this->load->model('order_model');
      	$this->load->model('creditorder_model');

      	$result = $this->$input[1]->getProductTransaction($input[0]);
	      $html = $this->getProductTransactionByOrdersTable($result);

	      if($result[0]->discountamount)
	     	 	$discount = ($result[0]->discountamount / ($result[0]->total + $result[0]->discountamount - ($result[0]->additionalamount ? $result[0]->additionalamount : 0))) * 100 . ' %';
	     	else
	     	 	$discount = '-';

        $this->output->set_output(json_encode([$html, $discount, ($result[0]->additionalamount ? 'P ' . number_format($result[0]->additionalamount, 2) : '-')]));
	  	}
	  }


		private function getProductTransactionByOrdersTable($data)
		{
			$html = '';
			foreach ($data as $key => $value) {
				$price = $value->pricestatus;
				$html .= '<tr><td>' . ucwords($value->longdesc) . '</td><td>' 
							. $value->qty . '</td><td>P ' 
							. number_format($value->$price, 2)
							. '</td><td>P ' . number_format($value->totalamount, 2)
							. '</td></tr>';
			}
			$html .= '<tr class="bold"><td colspan="3" class="text-center">Total</td><td> P ' . number_format(($data[0]->total + $data[0]->discountamount), 2) . '</td></tr>';
			if($data[0]->discountamount)
				$html .= '<tr class="bold"><td colspan="3" class="text-center">Discounted Price</td><td> P ' . number_format($data[0]->total, 2) . '</td></tr>';
			return $html;
		}

	  private function dateFormat($date)
	  {
	  	$formatted = [];
	  	foreach ($date as $key => $value) {
	  		if($key == 'from' || $key == 'to')
	  			$formatted[$key] = date_format(date_create($value), 'Y-m-d');
	  	}
	  	return $formatted;
	  }

	  private function dateDiff($date)
	  {
	  	$dif = date_diff(date_create($date['from']), date_create($date['to']))->format('%a');

    	switch ($dif) {
    		case $dif <= 14:
    			return 'DAY';
    			break;
    		case $dif > 14 && $dif <= 120:
    			return 'WEEK';
    			break;
    		case $dif > 120: 
    			return 'MONTH';
    			break;
    	}
	  }
	}
?>