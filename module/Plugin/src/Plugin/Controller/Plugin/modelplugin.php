<?php

namespace Plugin\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class modelplugin extends routeplugin {

    public $albumdetailsTable;
    public $userTable;
    public $trackdetailsTable;
    public $mailconfirmationTable;
    public $friendsTable;
    public $pagedetailsTable;
    public $adminTable;
    public $uploadDetailsTable;
    public $uploadBackupTable;
    public $tributedetailsTable;
    public $likesdetailsTable;
    public $userbackupTable;
    public $seoTable;
    public $bgimageTable;

    public function getalbumdetailsTable() {
        if (!$this->albumdetailsTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->albumdetailsTable = $sm->get('Album\Model\albumdetailsTable');
        }
        return $this->albumdetailsTable;
    }
    public function getuserTable() {
        if (!$this->userTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->userTable = $sm->get('Authorization\Model\userTable');
        }
        return $this->userTable;
    }
    public function getuserbackupTable() {
        if (!$this->userbackupTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->userbackupTable = $sm->get('Authorization\Model\userbackupTable');
        }
        return $this->userbackupTable;
    }
    public function gettrackdetailsTable() {
        if (!$this->trackdetailsTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->trackdetailsTable = $sm->get('Authorization\Model\trackdetailsTable');
        }
        return $this->trackdetailsTable;
    }
     public function getmailconfirmationTable() {
        if (!$this->mailconfirmationTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->mailconfirmationTable = $sm->get('Album\Model\mailconfirmationTable');
        }
        return $this->mailconfirmationTable;
    }
	public function getuploadDetailsTable() {
        if (!$this->uploadDetailsTable) {
            $sm = $this->getController()->getServiceLocator();
            $this->uploadDetailsTable = $sm->get('Profile\Model\uploadDetailsTable');
        }
        return $this->uploadDetailsTable;
    }
    public function getuploadBackupTable() {
        if (!$this->uploadBackupTable) {
            $sm = $this->getController()->getServiceLocator();
            $this->uploadBackupTable = $sm->get('Profile\Model\uploadBackupTable');
        }
        return $this->uploadBackupTable;
    }
    public function getfriendsTable() {
        if (!$this->friendsTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->friendsTable = $sm->get('Album\Model\friendsTable');
        }
        return $this->friendsTable;
    }
    public function getpagedetailsTable() {
        if (!$this->pagedetailsTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->pagedetailsTable = $sm->get('Profile\Model\pagedetailsTable');
        }
        return $this->pagedetailsTable;
    }
    public function getadminTable() {
        if (!$this->adminTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->adminTable = $sm->get('Backend\Model\adminTable');
        }
        return $this->adminTable;
    }

    public function gettributedetailsTable() {
        if (!$this->tributedetailsTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->tributedetailsTable = $sm->get('Album\Model\tributedetailsTable');
        }
        return $this->tributedetailsTable;
    }
    public function getlikesdetailsTable() {
        if (!$this->likesdetailsTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->likesdetailsTable = $sm->get('Album\Model\likesdetailsTable');
        }
        return $this->likesdetailsTable;
    }
    public function getseoTable() {
        if (!$this->seoTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->seoTable = $sm->get('Backend\Model\seoTable');
        }
        return $this->seoTable;
    }
    public function getbgimageTable() {
        if (!$this->bgimageTable) {

            $sm = $this->getController()->getServiceLocator();
            $this->bgimageTable = $sm->get('Backend\Model\bgimageTable');
        }
        return $this->bgimageTable;
    }
}

?>
