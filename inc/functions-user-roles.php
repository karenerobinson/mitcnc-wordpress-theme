<?php
    /**
     * Adds the GUI for selecting multiple roles per user
     */
    function mrpu_add_multiple_roles_ui( $user ) {
        $roles = get_editable_roles();
        $user_roles = array();
        if( $user == 'add-new-user' ) {
            if( !current_user_can( 'create_users' ) ) return;
            if(isset($_POST['mrpu_user_roles'])){
                $user_roles = in_array( $_POST['mrpu_user_roles'], array_keys( $roles ) );
            }
        } else {
            if( !current_user_can( 'edit_user', $user->ID ) ) return;
            $user_roles = array_intersect( array_values( $user->roles ), array_keys( $roles ) );
        }
        ?>
        <div id="mrpu-roles-container">
            <h3><?php _e( 'User Roles', 'multiple-roles-per-user' ); ?></h3>
            <table class="form-table">
                <tr id="mrpu-roles-container-tr">
                    <th><label for="user_credits"><?php _e( 'Roles', 'multiple-roles-per-user' ); ?></label></th>
                    <td>
                        <?php foreach ( $roles as $role_id => $role_data ) : ?>
                            <label for="user_role_<?php echo esc_attr( $role_id ); ?>" class="user_role_<?php echo esc_attr( $role_id ); ?>">
                                <input type="checkbox" id="user_role_<?php echo esc_attr( $role_id ); ?>" value="<?php echo esc_attr( $role_id ); ?>" name="mrpu_user_roles[]"<?php global $pagenow; if (( $pagenow == 'user-edit.php' ))  { echo in_array( $role_id, $user_roles ) ? ' checked="checked"' : ''; } ?> style="width: 16px;" />
                                <?php echo $role_data['name']; ?>
                            </label>
                            <br />
                        <?php endforeach; ?>
                        <br />
                        <span class="description"><?php _e( 'Select one or more roles for this user.<br/><strong>Hint:</strong> for Administrators, please select only "Administrator" role.', 'multiple-roles-per-user' ); ?></span>
                        <?php wp_nonce_field( 'mrpu_set_roles', '_mrpu_roles_nonce' ); ?>
                    </td>
                </tr>
            </table>
        </div>
        <script type="text/javascript">
            (function(callback) {
                var prefix = '', done = 0,
                    action = addEventListener||(prefix='on',attachEvent),
                    unaction = removeEventListener||detachEvent;
                var caller = function() {
                    if(!/complete|loaded|interactive/.test(document.readyState) || done++) return;
                    callback();
                    unaction.call(window, prefix+'load', caller, false);
                    unaction.call(document, prefix+'readystatechange', caller, false);
                };
                action.call(window, prefix+'load', caller, false);
                action.call(document, prefix+'readystatechange', caller, false);
                caller();
            })(function() {
                var elem = document.getElementById('role');
                var mrpu = document.getElementById('mrpu-roles-container');
                var mrputr = document.getElementById('mrpu-roles-container-tr');
                while(elem && elem.tagName != 'TR') elem = elem.parentNode;
                if(elem && mrpu && mrputr) {
                    elem.innerHTML = mrputr.innerHTML;
                    mrpu.parentNode.removeChild(mrpu);
                }
            });
        </script>
    <?php }
    add_action( 'edit_user_profile', 'mrpu_add_multiple_roles_ui', 0 );
    add_action( 'user_new_form', 'mrpu_add_multiple_roles_ui', 0 );

    /**
     * Saves the selected roles for the user
     */
    function mrpu_save_multiple_user_roles( $user_id ) {
        // Not allowed to edit user - bail
        if ( ! current_user_can( 'edit_user', $user_id ) || ! wp_verify_nonce( $_POST['_mrpu_roles_nonce'], 'mrpu_set_roles' ) ) {
            return;
        }

        $user = new WP_User( $user_id );
        $roles = get_editable_roles();
        $new_roles = isset( $_POST['mrpu_user_roles'] ) ? (array) $_POST['mrpu_user_roles'] : array();
        // Get rid of any bogus roles
        $new_roles = array_intersect( $new_roles, array_keys( $roles ) );
        $roles_to_remove = array();
        $user_roles = array_intersect( array_values( $user->roles ), array_keys( $roles ) );
        if ( ! $new_roles ) {
            // If there are no roles, delete all of the user's roles
            $roles_to_remove = $user_roles;
        } else {
            $roles_to_remove = array_diff( $user_roles, $new_roles );
        }

        foreach ( $roles_to_remove as $_role ) {
            $user->remove_role( $_role );
        }

        if ( $new_roles ) {
            // Make sure that we don't call $user->add_role() any more than it's necessary
            $_new_roles = array_diff( $new_roles, array_intersect( array_values( $user->roles ), array_keys( $roles ) ) );
            foreach ( $_new_roles as $_role ) {
                $user->add_role( $_role );
            }
        }
    }
    add_action( 'edit_user_profile_update', 'mrpu_save_multiple_user_roles' );
    add_action( 'user_register', 'mrpu_save_multiple_user_roles' );

    /**
     * Gets rid of the "Role" column and adds-in the "Roles" column
     */
    function mrpu_add_roles_column( $columns ) {
        $old_posts = isset( $columns['posts'] ) ? $columns['posts'] : false;
        unset( $columns['role'], $columns['posts'] );
        $columns['mrpu_roles'] = __( 'Roles', 'multiple-roles-per-user' );
        if ( $old_posts ) {
            $columns['posts'] = $old_posts;
        }

        return $columns;
    }
    add_filter( 'manage_users_columns', 'mrpu_add_roles_column' );

    /**
     * Displays the roles for a user
     */
    function mrpu_display_user_roles( $value, $column_name, $user_id ) {
        static $roles;
        if ( ! isset( $roles ) ) {
            $roles = get_editable_roles();
        }
        if ( 'mrpu_roles' == $column_name ) {
            $user = new WP_User( $user_id );
            $user_roles = array();
            $_user_roles = array_intersect( array_values( $user->roles ), array_keys( $roles ) );
            foreach ( $_user_roles as $role_id ) {
                $user_roles[] = $roles[ $role_id ]['name'];
            }

            return implode( ', ', $user_roles );
        }

        return $value;
    }
    add_filter( 'manage_users_custom_column', 'mrpu_display_user_roles', 10, 3 );

    /*add_role('speaker', __( 'Speaker' ), ['read' => true]);
    add_role('leadership', __( 'Leadership' ), ['read' => true]);
    add_role('volunteer', __( 'Volunteer' ), ['read' => true]);
    add_role('president', __( 'President' ), ['read' => true]);
    add_role('director', __( 'Director' ), ['read' => true]);
    remove_role( 'speaker' );
    remove_role( 'leadership' );
    remove_role( 'volunteer' );
    remove_role( 'president' );
    remove_role( 'director' ); */