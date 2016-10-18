<?php

namespace Plugin\MdlPaygent\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * PaymentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MdlPaymentMethodRepository extends EntityRepository
{

    /**
     * @var array array of configs
     */
    private $config;

    /**
     * Set the config of this repository
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * Find or create payment method
     *
     * @param type $id
     * @return type
     */
    public function findOrCreate($id)
    {
        if ($id == 0) {
            $Payment = new \Plugin\MdlPaygent\Entity\MdlPaymentMethod();
            $Payment
                ->setDelFlg(0)
                ->setUpdateDate('CURRENT_TIMESTAMP')
                ->setCreateDate('CURRENT_TIMESTAMP');
        } else {
            $Payment = $this->find($id);
        }

        return $Payment;
    }

    /**
     * find all
     *
     * @return type
     */
    public function findAllArray()
    {

        $query = $this
            ->getEntityManager()
            ->createQuery('SELECT p FROM Eccube\Entity\Payment p INDEX BY p.id');
        $result = $query
            ->getResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    /**
     * Find mul pay payment
     *
     * @return type
     */
    public function findMulPayPayments()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('p.id, p.method, g.memo03')
            ->from('\Eccube\Entity\Payment', 'p')
            ->innerJoin('\Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'g', 'WITH', 'p.id = g.id')
            ->where($qb->expr()->andx(
                $qb->expr()->eq('g.code', ':code'))
            );
        $qb->setParameter('code', $this->config['MDL_PAYGENT_CODE']);

        $ret = $qb
            ->getQuery()
            ->getResult();


        return $ret;
    }

    /**
     * Find mul pay payment
     *
     * @return type
     */
    public function findPaymentById($paymentId)
    {
    	$qb = $this->getEntityManager()->createQueryBuilder();
    	$qb
    	->select('p.id, p.method, g.memo03')
    	->from('\Eccube\Entity\Payment', 'p')
    	->innerJoin('\Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'g', 'WITH', 'p.id = g.id')
    	->where($qb->expr()->andx(
    			$qb->expr()->eq('g.code', ':code'),
    			$qb->expr()->eq('g.id', ':paymentId'))
    			);
    	$qb->setParameter('code', $this->config['MDL_PAYGENT_CODE']);
    	$qb->setParameter('paymentId', $paymentId);

    	$ret = $qb
    	->getQuery()
    	->getResult();

    	return $ret;
    }

    public function getPaymentByCode($incDel,$app)
    {
        $softDeleteFilter = $app['orm.em']->getFilters()->getFilter('soft_delete');
        $originExcludes = $softDeleteFilter->getExcludes();

        if ($incDel){
            $softDeleteFilter->setExcludes(array(
                'Eccube\Entity\Payment',
                'Plugin\MdlPaygent\Entity\MdlPaymentMethod'
            ));
        }


        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('p.id')
            ->from('\Eccube\Entity\Payment', 'p')
            ->innerJoin('\Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'g', 'WITH', 'p.id = g.id')
            ->where($qb->expr()->andx(
                $qb->expr()->eq('g.code', ':code'))
            );
        $qb->setParameter('code', $this->config['MDL_PAYGENT_CODE']);

        $ret = $qb
            ->getQuery()
            ->getResult();

        if ($incDel){
            $softDeleteFilter->setExcludes($originExcludes);
        }

        return $ret;


    }

    public function getPaymentDB($Payment = null)
    {
    	$qb = $this->getEntityManager()->createQueryBuilder();
    	$qb
    	->select('g.code as code, g.memo01 as merchant_id,
    			g.memo02 as connect_id, g.memo03 as payment, g.memo04 as connect_password,
    			g.memo05 as other_param')
    	->from('\Eccube\Entity\Payment', 'p')
    	->innerJoin('\Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'g', 'WITH', 'p.id = g.id')
    	->where($qb->expr()->andx(
    			$qb->expr()->eq('g.code', ':code')
    			));
    	$qb->setParameter('code', $this->config['MDL_PAYGENT_CODE']);
    	if ($Payment != null) {
    		$qb->andWhere(
    				$qb->expr()->eq('g.memo03', ':memo03'));
    		$qb->setParameter('memo03', $Payment);
    	}

    	$ret = $qb
    	->getQuery()
    	->getResult();

    	return $ret;
    }

    /**
     * Get payment by type, with option to including or excluding deleted record
     *
     * @param type $paymentTypeId
     * @param type $app
     * @return type
     */
    public function getPaymentByType($paymentTypeId, $incDel, $app)
    {
        $softDeleteFilter = $app['orm.em']->getFilters()->getFilter('soft_delete');
        $originExcludes = $softDeleteFilter->getExcludes();

        if ($incDel){
            $softDeleteFilter->setExcludes(array(
                'Eccube\Entity\Payment',
                'Plugin\MdlPaygent\Entity\MdlPaymentMethod'
            ));
        }

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('p')
            ->from('\Eccube\Entity\Payment', 'p')
            ->join('\Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'g', 'WITH', 'p.id = g.id')
            ->where(
                $qb->expr()->eq('g.memo03', ':x')
            );
        $qb->setParameter('x', $paymentTypeId);

        $ret = $qb
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();

        if ($incDel){
            $softDeleteFilter->setExcludes($originExcludes);
        }

        return $ret;
    }

    /**
     * Get payment from dtb_payment by id, with option to including or excluding deleted record
     *
     * @param type $id, $incDel, $app
     * @param type $app
     * @return object Payment
     */
    public function getAllPaymentMethods($id, $incDel, $app)
    {
        $softDeleteFilter = $app['orm.em']->getFilters()->getFilter('soft_delete');
        $originExcludes = $softDeleteFilter->getExcludes();

        if ($incDel){
            $softDeleteFilter->setExcludes(array(
                'Eccube\Entity\Payment',
                'Plugin\MdlPaygent\Entity\MdlPaymentMethod'
            ));
        }

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('p')
            ->from('\Eccube\Entity\Payment', 'p')
            ->join('\Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'g', 'WITH', 'p.id = g.id')
            ->where(
                $qb->expr()->eq('p.id', ':id')
            );
        $qb->setParameter('id', $id);

        $ret = $qb
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();

        if ($incDel){
            $softDeleteFilter->setExcludes($originExcludes);
        }

        return $ret;
    }

    public function getMdlPayment($field, $value, $incDel, $app){
        $softDeleteFilter = $app['orm.em']->getFilters()->getFilter('soft_delete');
        $originExcludes = $softDeleteFilter->getExcludes();

        if ($incDel){
            $softDeleteFilter->setExcludes(array(
                'Plugin\MdlPaygent\Entity\MdlPaymentMethod'
            ));
        }

        $MdlPayment = $app['orm.em']->getRepository('\Plugin\MdlPaygent\Entity\MdlPaymentMethod')
                      ->findOneBy(array($field => $value));

        if ($incDel){
            $softDeleteFilter->setExcludes($originExcludes);
        }

        return $MdlPayment;

    }

    /**
     * Get payment list
     *
     * @return type
     */
    public function getPaymentList()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('p.id')
            ->from('\Eccube\Entity\Payment', 'p')
            ->join('\Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'g', 'WITH', 'p.id = g.id')
            ->where(
                $qb->expr()->eq('g.code', ':x')
            );
        $qb->setParameter('x', $this->config['PG_MULPAY_CODE']);
        return $qb
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * Delete payment
     *
     * @param type $paymentId
     * @return boolean
     */
    public function deletePayment($paymentId)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('p')
            ->from('\Eccube\Entity\Payment', 'p')
            ->where($qb->expr()->andx(
                $qb->expr()->eq('p.del_flg', 0),
                $qb->expr()->eq('p.id', ':id'))
            );
        $qb->setParameter('id', $paymentId);

        try {
            $Payment = $qb
                ->getQuery()
                ->setMaxResults(1)
                ->getSingleResult();

        } catch (\Exception $e) {
            return false;
        }

        $em = $this->getEntityManager();
        $em->remove($Payment);
        $em->flush();

        return true;
    }

    function getMdlRegistMethod($code)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('g')
            ->from('\Eccube\Entity\Payment', 'p')
            ->innerJoin('\Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'g', 'WITH', 'p.id = g.id')
            ->where($qb->expr()->andx(
                $qb->expr()->eq('g.memo03', ':memo03')),
                $qb->expr()->eq('p.del_flg', 0),
                $qb->expr()->eq('g.del_flg', 0),
                $qb->expr()->eq('g.code', ':code')
            );
        $qb->setParameter('memo03', $this->config['PG_MULPAY_PAYID_REGIST_CREDIT']);
        $qb->setParameter('code', $code);
        $ret = $qb
            ->getQuery()
            ->getResult();
        return $ret;
    }

    //get payment card customer
    function getPaymentCardCustomerById($id)
    {
    	$qb = $this->getEntityManager()->createQueryBuilder();
    	$qb
    	->select('p')
    	->from('Plugin\MdlPaygent\Entity\Customer', 'p')
    	->where(
    			$qb->expr()->eq('p.del_flg', 0),
    			$qb->expr()->eq('p.id', ':customer_id')
    			);
    	$qb->setParameter('customer_id', $id);
    	$ret = $qb
    	->getQuery()
    	->getResult();
    	return $ret;
    }

    //get payment card customer
    function getMemoByOrderId($order_id)
    {
    	$qb = $this->getEntityManager()->createQueryBuilder();
    	$qb
    	->select('p')
    	->from('Plugin\MdlPaygent\Entity\MdlPaymentMethod', 'p')
    	->where(
    			$qb->expr()->eq('p.id', ':order_id')
    			);
    	$qb->setParameter('order_id', $order_id);
    	$ret = $qb
    	->getQuery()
    	->getArrayResult();
    	return $ret;
    }
}
