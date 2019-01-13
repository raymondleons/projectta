<?php
class AG {
    private $siswa = array(); //data siswa
    private $waktu = array(); //data waaktu
    private $ruang = array(); //data ruang
    private $terapis = array(); //data waktu
    
    var $num_crommosom ; //jumlah kromosom awal yang dibangkitkan
    var $generation = 0; //generasi ke....
    var $max_generation = 2;
    var $crommosom = array(); //array kromosom sesuai $num_cromosom 
    var $per_sks = 45; // menit per sks
    var $success = false; //keadaan jika sudah ada sulosi terbaik
    var $debug = true; //menampilkan debug jika diset true;    
    var $fitness = array(); //nilai fitness setiap kromosom
    var $console = ""; //menyimpan proses algoritma 
    var $total_fitness = 0; //menyimpan total fitness untuk masing-masing kromosom
    var $probability  = array(); //menyimpan probabilitas fitness masing-masing kromosom
    var $com_pro = array(); //menyimpan fitness komulatif untuk masing masing kromosom
    var $rand = array(); //menyimpan bilangan rand())
    var $parent = array(); //menyimpan parent saat crossover
    
    var $best_fitness = 0; //menyimpan nilai fitness tertinggi
    var $best_cromossom = array(); //menyimpan kromosom dengan fitness tertinggi 
    
    var $crossover_rate = 75; //prosentase kromosom yang akan dipindah silang
    var $mutation_rate = 25; //prosentase kromosom yang akan dimutasi
    
    var $time_start; //menyimpan waktu mulai proses algotitma
    var $time_end; //menyimpan waktu selesai proses algoritma
    
    /**
     * konstruktor ketiga pertama kali memanggil class AG
     * inputan waktu, ruang, dan siswa 
     */
    function __construct($siswa, $waktu, $ruang, $terapis) {                        
        foreach($siswa as $row){
            $this->siswa[$row->kode_siswa] = $row; // menampilkan semua nilai atau index array ( do while, while )
        }
        foreach($ruang as $row){
            $this->ruang[$row->jenis][$row->kode_ruang] = $row; // menampilkan semua nilai atau index array ( do while, while )
        }
        foreach($waktu as $row){
            $this->waktu[$row->kode_waktu] = $row; // menampilkan semua nilai atau index array ( do while, while )
        }
        foreach($terapis as $row){
            $this->terapis[$row->kode_terapis] = $row; // menampilkan semua nilai atau index array ( do while, while )
        }
    }          
    /**
     * mulai memproses algoritma     
     */
    function generate(){
        global $db;
        
        $this->time_start = microtime(true); //seting watu awal eksekusi
        
        $this->generate_crommosom(); // memanggil generasi kromosom
        
        /**
         * proses algoritma akan diulang sampai memperoleh nilai 1
         * atau sudah mencapai maksimum generasi (sesuai yang diinputkan)
         */                        
        while(($this->generation < $this->max_generation) && $this->success == false){       
            $this->generation++;  // memanggil generasi dengan perulangan    
            $this->console.= "<h4>Generasi ke-$this->generation</h4>"; // menampilkan generasi
            $this->show_crommosom(); //menampilkan kromosom
            $this->calculate_all_fitness(); // menghitung fitnes
            $this->show_fitness(); // menampilkan fitnes
                        
            if(!$this->success) { //jika fitness terbaik belum mencapai 1, dilanjutkan ke proses seleksi
                $this->get_com_pro(); // memanggil kombinasi
                $this->selection(); // menampilkan seleksi
                $this->show_crommosom();  // menampilkan kromosom           
                $this->show_fitness(); // menampilkan fitnes
            }       
            if(!$this->success) { //jika fitness terbaik belum mencapai 1, dilanjutkan ke proses crossover
                $this->crossover();  // memanggil proses persilangan
                $this->show_crommosom(); // menampilkan kromosom 
                $this->show_fitness(); // menampilkan fitnes
            }     
            
            if(!$this->success) { //jika fitness terbaik belum mencapai 1, dilanjutkan ke proses mutasi
                $this->mutation(); // memanggil proses mutasi
                $this->show_crommosom(); // menampilkan kromosom 
                $this->show_fitness(); // menampilkan fitnes
            }                                
        }        
        $this->save_result(); //menyimpan jadwal hasil AG
        
        $this->time_end = microtime(true); //seting waktu akhir eksekusi
        
        $time = $this->time_end - $this->time_start;  // menampilkan waktu mulai dan berakhir
        
        /**
         * menampilan hasil algoritma
         */
        echo "<pre style='font-size:0.8em'>\nFITNESS TERBAIK: $this->best_fitness"; // menampilkan hasil fitnes terbaik
        echo "\nExecution Time: $time seconds"; // menampilkan waktu eksekusi
        echo "\nMemory Usage: " . memory_get_usage() / 1024 . ' kilo bytes'; // menampilkan memori yang digunakan
        echo "\nGENERASI: $this->generation"; // menampilkan generasi
        echo "\nCROMOSSOM TERBAIK:  " . $this->print_cros($this->best_cromossom) . "</pre>"; // menampilkan kromosom terbaik 
        
        //menampilkan proses algoritma                             
        $this->get_debug();                                   
    }
    /**
     * menghapus jadwal sebelumnya
     * menyimpan hasil jadwal yang baru
     */
    function save_result(){
        global $db;                
        $db->query("TRUNCATE tb_jadwal");
        foreach($this->best_cromossom as $key => $val){
            $db->query("INSERT INTO tb_jadwal (kode_siswa, kode_waktu, kode_ruang) 
                VALUES ('$val[siswa]', '$val[waktu]', '$val[ruang]')"); // menampilkan jadwal terapi
        }
    }    
    /**
     * proses mutasi pada AG
     * mutasi dilakukan sesuai prosentaso "Mutation Rate" yang diinputkan
     */
    function mutation(){
        $mutation = array();
        $this->console.= "<h5>Mutasi generasi ke-$this->generation</h5>"; // menampilkan generasi
        $gen_per_cro = count($this->siswa); // menghitung jumlah siswa
        $total_gen = count($this->crommosom) * $gen_per_cro; // menghitung total gen
        $total_mutation = ceil($this->mutation_rate / 100 * $total_gen); // menghitung total mutasi dengan pembulatan keatas
        
        $keys = array_keys($this->siswa); // memanggil array siswa

        for($a = 1; $a <= $total_mutation; $a++) {
            $val = rand(1, $total_gen); // random total gen
            
            $cro_index = ceil($val / $gen_per_cro) - 1; // menghitung index cromosom cromosom ( ceil = membulatkan bilangan keatas )
            $gen_index = ( ($val -1)  % $gen_per_cro); // menghitung gen index
                        
            $gen_key = $keys[$gen_index]; // memanggil gen 

            $this->console.="$val : [$cro_index, $gen_index] : $gen_key\n"; // menampilkan gen 

            $jenis = $this->siswa[$gen_key]->jenis; // memanggil siswa sebagai variabel jenis
            
            $this->crommosom[$cro_index][$gen_key]['ruang'] = array_rand($this->ruang[$jenis]); // memanggil array random ruang
            $this->crommosom[$cro_index][$gen_key]['waktu'] = array_rand($this->waktu); // memanggil array random waktu
            $this->crommosom[$cro_index][$gen_key]['terapis'] = array_rand($this->terapis); // memanggil array random terapis

            $this->fitness[$cro_index] = $this->calculate_fitness($cro_index); // memanggil perhitungan fitnes
            
            if($this->success)
                return;
        }
        return false;
    }
    //mencari nilai crossover dari dua induk
    function get_crossover($key1, $key2){
        $cro1 = $this->crommosom[$key1]; // memanggil kromosom 1
        $cro2 = $this->crommosom[$key2]; // memanggil kromosom 2
        
        $offspring = rand(0, count($cro1) - 2); // jumlah kromosom 1 -2
        $new_cro = array();
        
        $a = 0;
        foreach($cro1 as $key => $val){
            if($a <= $offspring)
                $new_cro[$key] = $cro1[$key]; // kromosom 1
            else
                $new_cro[$key] = $cro2[$key]; // kromosom 2
        }     
        $this->console.= "Offspring: $offspring\n";  //menampilkan offspring        
        return $new_cro;        
    }
    /**
     * proses Crossover (pindah silang pada AG)
     */
    function crossover(){
        $this->console.= "<h5>Pindah silang generasi ke-$this->generation</h5>"; // menampilkan generasi
        $parent = array();
        
        //menentukan kromosom mana saja sebagai induks
        //jumlahnya berdasarkan crossover rate 
        foreach($this->crommosom as $key => $val) {
            $rnd = mt_rand() / mt_getrandmax();
            if($rnd <= $this->crossover_rate / 100)
                $parent[] = $key;
        }        
        //reset($this->crommosom);
        
        //menampilkan parent/induk setiap pindah silang        
        foreach($parent as $key => $val) {
            $this->console.="Parent[$key] : $val \n"; //menampilkan parent
        }
                
        $parent = $parent;
        $c = count($parent);
        
        //mulai proses pindah silang sesai jumlah induk
        if( $c > 1 ) {
            for($a = 0; $a < $c-1; $a++) {
                $new_cro[$parent[$a]] = $this->get_crossover( $parent[$a],  $parent[$a+1]); // persilangan
            }    
            $new_cro[$parent[$c-1]] = $this->get_crossover( $parent[$c-1],  $parent[0]); // persilangan 
            
            //menyimpan kromosom hasil pindah silang dan fitnessnya
            foreach($new_cro as $key => $val) {
                $this->crommosom[$key] = $val; // memanggil kromosom
                $this->calculate_fitness($key); // memanggil hitung fitnes
            }
        }                         
    }
    /**
     * memilih berdasarkan bilangan random yang diinputkan
     * */
    function choose_selection($rand_numb = 0) {    
        foreach($this->com_pro as $key => $val) {
            if($rand_numb <= $val)
                return $key;
        }        
    }
    function get_rand(){
        $this->rand = array();
        //reset($this->fitness);
        foreach($this->fitness as $key => $val) {
            $r = mt_rand() / mt_getrandmax();
            $this->rand[] = $r;
            //$this->console.="R[$key] : $r \n";
        }
    }
    /**
     * proses seleksi, memilih gen secara acak
     * dimana fitness yang besar mendapatkan kesempatan yang lebih besar
     */
    function selection(){        
        $this->console.="<h5>Seleksi generasi ke-$this->generation</h5>"; //menampilkan generasi
        $this->get_rand(); // memanggil random bilangan
        $new_cro = array();   // membuat array      
        foreach ($this->rand as $key => $val) {
            $k = $this->choose_selection($val); // memilih gen
            $new_cro[$key] = $this->crommosom[$k]; // kromosom baru
            $this->fitness[$key] = $this->fitness[$k]; // nilai fitnes
            $this->console.="K[$key] = K[$k] \n"; // menampilkan key
        }  
        $this->crommosom = $new_cro; // memanggil kromosom
    }    
    /**
     * mencari probabilitas untuk setiap fitness
     * rumusnya adalah  fitness / total fitness
     */     
    function get_probability(){
        $this->probability = array();
        foreach($this->fitness as $key => $val) {
            $x = $val['nilai'] / $this->total_fitness; //menghitung nilai probabilitas
            $this->probability[] = $x; // memanggil nilai probanilitas
            //$this->console.="P[$key] : $x \n";
        }
        //$this->console.="Total P: " . array_sum($this->probability) . "\n";        
        return $this->probability;
    }    
    /**
     * mencari nilai probabilitas komulatif
     * 
     * */
    function get_com_pro(){
            
        $this->get_probability(); // memanggil probabilitas

   
        $this->com_pro = array(); // membuat array
        $x = 0;
        foreach($this->probability as $key => $val) {
            $x+= $val;
            $this->com_pro[] = $x;
            $this->console.="PK[$key] : $x \n"; // menampilkan key
        }                
        $this->com_pro; // memanggil com_pro
    }
    /**
     * mencari garis 
     */
    function get_total_fitness(){
        $this->total_fitness = 0; // memanggil total fitness
        //reset($this->fitness);
        foreach($this->fitness as $val) {
            $this->total_fitness+=$val['nilai']; // memanggil total fitness
        }        
        return $this->total_fitness;
    }     
    /**
     * menampilkan nilai fitnes untuk masing-masing kromosom
     */
    function show_fitness(){
        foreach($this->fitness as $key => $fit) {                                    
            $this->console.= "F[$key]: $fit[desc] = $fit[nilai] \n"; //menampilkan nilai                       
        }
        //reset($this->fitness);
        $this->get_total_fitness();
        $this->console.="Total F: ".$this->total_fitness ."\n"; // memanggil total fitnes
    }
    /**
     * mengecek apakah ruang yang sama di waktu yang bentrok
     * ada kombinasi pengecekan untuk semua gen
     * misal gen 1 dan 2, 1 dan 3, 1 dan 4 dst...
     * begitu juga gen 2 dan 3, 2 dan 4 dst
     * sampai semua kombinasi
     * 
     */                
    function get_clash_ruang($crom = array()) {
        $clash = 0;        
        foreach($crom as $key => $val){
            foreach($crom as $k => $v){
                if($key!=$k){
                    if($val['ruang']==$v['ruang']){
                        if($val['waktu']==$v['waktu']){
                            $clash++;
                        }
                    }
                }
            }
        }
        return $clash;
    }
    /**
     * mengecek apakah terapis yang sama di waktu yang bentrok
     * ada kombinasi pengecekan untuk semua gen
     * misal gen 1 dan 2, 1 dan 3, 1 dan 4 dst...
     * begitu juga gen 2 dan 3, 2 dan 4 dst
     * sampai semua kombinasi
     * 
     */
    function get_clash_terapis($crom = array()) {
        $clash = 0;        
        foreach($crom as $key => $val){
            foreach($crom as $k => $v){
                if($key!=$k){
                    if($val['waktu']==$v['waktu']){
                        $terapis1 = $this->waktu[$val['waktu']]->kode_terapis;
                        $terapis2 = $this->waktu[$v['waktu']]->kode_terapis;
                        if($terapis1==$terapis2){
                            
                            $clash++;
                        }
                    }
                }                
            }
        }        
        return $clash;
    }
    /**
     * menghitung fitnes pada kromosom tertentu 
     */
    function calculate_fitness($key) {
        $cro = $this->crommosom[$key];
        //terapis sama waktu sama
        $clash_terapis = $this->get_clash_terapis($cro);
        //ruang sama waktu sama
        $clash_ruang = $this->get_clash_ruang($cro);
        
        $f['desc'] = "1/(1+$clash_terapis+$clash_ruang)";        //menghitung clash                               
        $f['nilai'] = 1/ (1 + $clash_terapis + $clash_ruang);    // menghitung fitnes
        
        if($f['nilai']==1) // jika sudah optimal maka berhenti
            $this->success = true;
        
        if($f['nilai'] > $this->best_fitness) {
            $this->best_fitness = $f['nilai']; //memanggil fitnes terbaik
            $this->best_cromossom = $this->crommosom[$key]; // memanggil kromosom terbaik
        }
        
        $this->fitness[$key] = $f; //memanggil fitnes
        return $f;
    }
    /**
     * menghitung fitness pada semua kromosom
     */
    function calculate_all_fitness() {            
        foreach($this->crommosom as $key => $val) {                             
            $this->calculate_fitness($key);      //memanggil fitness                   
        }
        //reset($this->crommosom);
    }
    /**
     * menampilkan satu kromosom sesuai indeks
     */
    function print_cros($val = array(), $key = 0){                    
        $arr = array(); //menjadikan array
        foreach($val as $k => $v) {                   
            $arr[] = '['. implode( ',', $v) . ']'; // menggabungkan kembali string yang telah dipecahkan
        }
        return "Kromosom[$key]: (". implode( ',', $arr) . ")";
    }
    /**
     * menampilkan semua kromosom 
     */
    function show_crommosom() { 
        $cros = $this->crommosom; //memanggil kromosom
        $a = array(); // menjadikan array
        foreach ($cros as $key => $val) {
            $a[] =  $this->print_cros($val, $key); //menampilkan kromosom 
        }        
        $this->console.= implode(" \n", $a) . "\n";
    }
    /**
     * membuat kromoson random(acak)
     */
    function get_rand_crommosom(){
        $result = array();
        $siswa = $this->siswa;        
        foreach($siswa as $key => $val){            
            $result[$key]['siswa'] = $key;
            $result[$key]['ruang'] = array_rand($this->ruang[$val->jenis]); // array random tabel ruang
            $result[$key]['waktu'] = array_rand($this->waktu); // array random tabel waktu
        }                
        return $result;                          
    }    
    /**
     * membuat kromosom awal sesuai jumlah kromosom yang diinputkan
     */        
    function generate_crommosom() {
        $numb = 0;
        while($numb < $this->num_crommosom) { //diulang sesuai jumlah kromosom yang diinputkan
            $cro = $this->get_rand_crommosom();  // memanggil kromosom acak          
            $this->crommosom[] = $cro;     // memanggil kromosom   
            $this->fitness[] = 0;   // memanggil nilai fitnes                                       
            $numb++;
        }           
    }     
    /**
     * menampilkan print out dari proses algoritma
     */
    function get_debug(){   
        if($this->debug)
            echo "<pre style='font-size:0.8em'>$this->console</pre>";
    }                    
}

//test