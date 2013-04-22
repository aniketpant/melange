<?php include 'application/views/inc/header.php'; ?>
    
                <section>
                    
                    <div class="page-header"><h1>Search Results <small>Results for "<?php echo $search_query; ?>"</small></h1></div>
                    
                    <div class="search-results">
                        <?php
                        if (!empty($search_results)) {
                        ?>
                            <ul class="thumbnails">
                        <?php
                            foreach($search_results as $row) {
                        ?>
                                <li>
                                    <figure class="profile">
                                        <a href="<?php echo site_url().'user/profile/'.$row->iduser_details ?>">
                                            <img class="thumbnail" src="<?php echo site_url().'uploads/'.$row->image_thumb; ?>" alt="<?php echo $row->name.'\'s Photograph' ?>" />
                                        </a>
                                        <figcaption><a class="name" href="<?php echo site_url().'user/profile/'.$row->iduser_details ?>"><?php echo $row->name; ?></a></figcaption>
                                    </figure>
                                </li>
                        <?php
                            }
                        ?>
                            </ul>
                        <?php
                        }
                        else {
                        ?>
                        <p>No results found.</p>
                        <?php
                        }
                        ?>                        
                    </div>
                    
                </section>

<?php include 'application/views/inc/footer.php'; ?>