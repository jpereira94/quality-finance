<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Category lists
        $categories = [
            'Alimentação' => [
                'Cafetaria',
                'Mantimentos',
                'Padaria',
                'Restauração',
                'Takeaway ',
                'Talho ',
            ],
            'Cuidados pessoais' => 'Cuidados pessoais',
            'Despesas bancárias' => [
                'Cheques ',
                'Comissão de cartão ',
                'Manutenção do depósito '],
            'Habitação' => [
                'Condomínio ',
                'Eletricidade ',
                'Esgotos ',
                'Gás ',
                'TV Internet ',
                'Água'],
            'Habitação (recheio)' => [
                'Decoração ',
                'Eletrodomésticos  ',
                'Mobília '],
            'Impostos' => [
                'IRS',
                'IUC',
                'Imposto de Selo'],
            'Juros' => [
                'Automóvel',
                'Habitação'],
            'Lazer' => [
                'Cinema',
                'Desporto',
                'Discoteca',
                'Museus'],
            'Saúde' => [
                'Consultas',
                'Fisioterapia',
                'Medicamentos',
                'Urgências'],
            'Telemóvel' => 'Telemóvel',
            'Transportes' => [
                'Comboio',
                'Combustível',
                'Estacionamento',
                'Inspeção',
                'Metro ',
                'Portagem',
                'Seguros'],
            'Vencimentos' => 'Vencimentos',
            'Vestuário' => 'Vestuário',
        ];

        foreach($categories as $category_base => $category)
        {
            //Create the new category
            $cb = \App\Category::create(['name' => $category_base]);

            //if there are sub categories then they are referenced as an array child of the category element
            if(is_array($category))
            {
                //iterate through every subcategory
                foreach($category as $name) {
                    $c = new \App\Category(['name' => $name]);
                    $cb->Child()->save($c);
                }
            }
        }

    }
}
