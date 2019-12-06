<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Entity\Product;
use App\Entity\Country;
use App\Entity\Price;

class ProductController extends AbstractController
{
    /**
     * @Route(
     *     "/product/get-price/{product_id}/{country_code}",
     *     name="getProductPrice",
     *     requirements={"countryCode"="^[a-zA-Z]{1,3}$"}
     * )
     * @Entity("product", expr="repository.find(product_id)")
     * @Entity("country", expr="repository.findOneByCode(country_code)")
     */
    public function getProductPrice(Product $product, Country $country, EntityManagerInterface $entityManager)
    {
        try {
            $priceRepository = $entityManager->getRepository(Price::class);
            $price = $priceRepository->findOneByProductAndCountry($product->getId(), $country->getId());
            return $this->json([
                'price' => $price->getValue(),
                'currency' => $country->getCurrency()
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @Route(
     *     "/product/get-last-id",
     *     name="getLastProductId",
     * )
     */
    public function getLastProductId(EntityManagerInterface $entityManager)
    {
        try {
            $productRepository = $entityManager->getRepository(Product::class);
            $product = $productRepository->findLast();
            return $this->json([
                'id' => $product->getId(),
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()]);
        }
    }
}
