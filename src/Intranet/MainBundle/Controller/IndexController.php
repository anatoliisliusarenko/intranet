<?php

namespace Intranet\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Intranet\MainBundle\Entity\TopicSection;

class IndexController extends Controller
{
	public function getTopicSectionsAction()
	{
		$repository = $this->getDoctrine()->getRepository("IntranetMainBundle:TopicSection");
		$topicSections = $repository->findAll();
		
		return $this->render("IntranetMainBundle:Index:topicSections.html.twig", array("topicSections" => $topicSections));
	}
	
    public function indexAction()
    {
        return $this->render('IntranetMainBundle:Index:index.html.twig');
    }
    
    public function showSectionAction($section_id)
    {
    	$repository = $this->getDoctrine()->getRepository("IntranetMainBundle:TopicSection");
    	$section = $repository->find($section_id);
    	if ($section == null)
    		return $this->redirect($this->generateUrl('intranet_main_homepage'));
    	
    	$this->get('twig')->addGlobal('activeSectionId', $section_id);
    	
    	return $this->render('IntranetMainBundle:Index:showSection.html.twig', array("section" => $section));
    }
    
    public function showTopicAction($topic_id)
    {
    	$repository = $this->getDoctrine()->getRepository("IntranetMainBundle:Topic");
    	$topic = $repository->find($topic_id);
    	if ($topic == null)
    		return $this->redirect($this->generateUrl('intranet_main_homepage'));
    	
    	$this->get('twig')->addGlobal('activeSectionId', $topic->getTopicSection()->getId());
    	
    	return $this->render('IntranetMainBundle:Index:showTopic.html.twig', array("topic" => $topic));
    }
}
