<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This file is part of the CStrike-Regnick package
 * 
 * (c) Gentle Software Solutions <www.gentle.ro>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// ------------------------------------------------------------------------

/**
 * Server controller
 * 
 * Provides servers listing
 * 
 * @package     CStrike-Regnick
 * @category    Controllers
 * @copyright   (c) 2011 - 2012 Gentle Software Solutions
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @link        http://www.gentle.ro/ 
 */
class Server extends MY_Controller
{
	
    /**
     * Fetch server members
     * 
     * @access  public
     * @return  void
     */
    public function members($serverID)
    {
        $this->load->model('server_model');
        
        $data = array(
            'page_title'    => lang('server_members'),
            'page_subtitle' => '',
            'users'         => $this->server_model->getMembers($serverID),
            'server_name'   => $this->server_model->getServer($serverID)->address,
        );
        
        $this->template->set_layout('one_col')->build('server/team', $data);
    }
    
    /**
     * Fetch server administration team
     * 
     * @access  public
     * @return  void
     */
    public function team($serverID)
    {
        $this->load->model('server_model');
        
        $data = array(
            'page_title'    => lang('server_team'),
            'page_subtitle' => '',
            'users'         => $this->server_model->getTeam($serverID),
            'server_name'   => $this->server_model->getServer($serverID)->address,
        );
        
        $this->template->set_layout('one_col')->build('server/team', $data);
    }
    
    /**
     * List servers
     * 
     * @access  public
     * @return  void
     */
	public function server_list($page = 0)
	{
        $this->load->model('server_model');
        $this->load->library('pagination');
        // + pagination config
        $config['base_url']     = site_url('server/list');
        $config['total_rows']   = $this->db->where('ID >', 0)->count_all_results('servers');
        $config['per_page']     = 12;
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        // - pagination config 
                
        $data = array(
            'page_title'    => lang('community_servers'),
            'page_subtitle' => 'Play with joy !',
            'servers'       => $this->server_model->getServers(false, $config['per_page'], $page),
        );
        
        $this->template->set_layout('one_col')->build('server/list', $data);
	}
}

/* End of file server.php */
/* Location: ./application/controllers/server.php */