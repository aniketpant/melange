
            </article>
            
            <?php include 'sidebar.php'; ?>
            
        </div>

        <footer id="footer" class="row" role="footer">
            
            <?php if ($this->session->userdata('admin_controls')) { ?>
            <p><span class="label label-important">Danger</span> Please leave this page if you are not an administrator.</p>
            <?php } ?>
            <p class="attr">Made by <a href="http://aniketpant.com/">Aniket Pant</a></p>
            <p>Made in 2012</p>
            
        </footer>
    
    </div>
    
</body>
</html>