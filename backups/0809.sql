PGDMP         %                u            hierro_peru    9.6.3    9.6.3 &    3	           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            4	           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            	          0    24583    area 
   TABLE DATA               H   COPY area (codigo_area, nombre, descripcion, encargado_per) FROM stdin;
    public       postgres    false    185   �        G	           0    0    area_codigo_area_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('area_codigo_area_seq', 14, true);
            public       postgres    false    186            	          0    24591    cargo 
   TABLE DATA               3   COPY cargo (codigo_cargo, descripcion) FROM stdin;
    public       postgres    false    187   c!       H	           0    0    cargo_codigo_cargo_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('cargo_codigo_cargo_seq', 6, true);
            public       postgres    false    188            	          0    24596    compra 
   TABLE DATA               X   COPY compra (codcompra, codproveedor, neto, fechacompra, igv_compra, total) FROM stdin;
    public       postgres    false    189   �!       I	           0    0    compra_codcompra_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('compra_codcompra_seq', 1, false);
            public       postgres    false    190            	          0    24601    correlativo 
   TABLE DATA               -   COPY correlativo (tabla, numero) FROM stdin;
    public       postgres    false    191   "       	          0    24604    detallecompra 
   TABLE DATA               V   COPY detallecompra (codproducto, codcompra, cantidad, preciocompra, item) FROM stdin;
    public       postgres    false    192   X"       	          0    24607    detalledevolucion 
   TABLE DATA               ;   COPY detalledevolucion (id_dev, id_prod, cant) FROM stdin;
    public       postgres    false    193   �"       (	          0    24814    detalleingreso 
   TABLE DATA               b   COPY detalleingreso (codigo_din, codigo_ing, codproducto, cantidad, idunidad, precio) FROM stdin;
    public       postgres    false    212   �"       J	           0    0    detalleingreso_codigo_din_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('detalleingreso_codigo_din_seq', 3, true);
            public       postgres    false    211            	          0    24610    detallepedido 
   TABLE DATA               p   COPY detallepedido (codpedido, codproducto, cantidad, pendiente, atendido, codigodet, unidadpedido) FROM stdin;
    public       postgres    false    194   #       K	           0    0    detallepedido_codigodet_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('detallepedido_codigodet_seq', 85, true);
            public       postgres    false    215            *	          0    24829    detallesalida 
   TABLE DATA               a   COPY detallesalida (codigo_dsa, codigo_sal, codproducto, cantidad, idunidad, precio) FROM stdin;
    public       postgres    false    214   S#       L	           0    0    detallesalida_codigo_dsa_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('detallesalida_codigo_dsa_seq', 18, true);
            public       postgres    false    213            	          0    24613 
   devolucion 
   TABLE DATA               A   COPY devolucion (id_dev, id_usuario, id_area, fecha) FROM stdin;
    public       postgres    false    195   �#       M	           0    0    devolucion_id_dev_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('devolucion_id_dev_seq', 1, false);
            public       postgres    false    196            $	          0    24788    ingreso 
   TABLE DATA               {   COPY ingreso (codigo_ing, numero_ing, codproveedor, fecha, estado, fechareg, usuarioreg, codigo_mi, codcompra) FROM stdin;
    public       postgres    false    208   �#       N	           0    0    ingreso_codigo_ing_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('ingreso_codigo_ing_seq', 1, false);
            public       postgres    false    207            -	          0    24866    motivoingreso 
   TABLE DATA               6   COPY motivoingreso (codigo_mi, nombre_mi) FROM stdin;
    public       postgres    false    217   	$       O	           0    0    motivoingreso_codigo_mi_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('motivoingreso_codigo_mi_seq', 1, false);
            public       postgres    false    216            /	          0    24878    motivosalida 
   TABLE DATA               5   COPY motivosalida (codigo_ms, nombre_ms) FROM stdin;
    public       postgres    false    219   U$       P	           0    0    motivosalida_codigo_ms_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('motivosalida_codigo_ms_seq', 2, true);
            public       postgres    false    218            	          0    24618    movimientokardex 
   TABLE DATA               �   COPY movimientokardex (codkardex, tipomovimiento, fechamovimiento, cantidadmovimiento, saldo, descripcion, codpedido, codproducto, codcompra) FROM stdin;
    public       postgres    false    197   �$       Q	           0    0    movimientokardex_codkardex_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('movimientokardex_codkardex_seq', 1, false);
            public       postgres    false    198            	          0    24626    pedido 
   TABLE DATA               V   COPY pedido (codpedido, codigo_usuario, fechapedido, descripcion, estado) FROM stdin;
    public       postgres    false    199   �$       	          0    24629    personal 
   TABLE DATA               �   COPY personal (dni, apellido_paterno, apellido_materno, nombres, direccion, telefono_fijo, telefono_movil1, telefono_movil2, email, codigo_cargo, codigo_area, dni_jefe, codpersonal) FROM stdin;
    public       postgres    false    200   �$       R	           0    0    personal_codpersonal_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('personal_codpersonal_seq', 6, true);
            public       postgres    false    220            	          0    24632    producto 
   TABLE DATA               h   COPY producto (codproducto, nombre, stock_min, stock, idunid, estado, precio, precio_venta) FROM stdin;
    public       postgres    false    201   n&       S	           0    0    producto_codproducto_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('producto_codproducto_seq', 15, true);
            public       postgres    false    202            	          0    24637 	   proveedor 
   TABLE DATA               W   COPY proveedor (codproveedor, razonsocial, razoncomercial, ruc, direccion) FROM stdin;
    public       postgres    false    203   i'       T	           0    0    proveedor_codproveedor_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('proveedor_codproveedor_seq', 3, true);
            public       postgres    false    204            &	          0    24806    salida 
   TABLE DATA               �   COPY salida (codigo_sal, numero_sal, codigo_area, usuario_area, fecha, estado, fechareg, usuarioreg, codigo_ms, codpedido) FROM stdin;
    public       postgres    false    210   �'       U	           0    0    salida_codigo_sal_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('salida_codigo_sal_seq', 3, true);
            public       postgres    false    209            !	          0    24642    unidad_medida 
   TABLE DATA               0   COPY unidad_medida (idunid, nombre) FROM stdin;
    public       postgres    false    205   (       "	          0    24645    usuario 
   TABLE DATA               F   COPY usuario (codigo_usuario, dni_usuario, clave, estado) FROM stdin;
    public       postgres    false    206   Y(       	   �   x�EN�q1=KU��������V[ۻ3pK)���P����m��R�E:0�aO�v3��"U��4�R��B���V���p�-Ln&��~@5��B�+��c��lm�X%	k�6�����@1Q�j�c�29�Q�b?��_�h9��WM|�5�|d:u�:��Of�����p����є^T��"� ��c�      	   T   x��K
� E�q�
WP�o���E�D��_G��r�F7.E�鼓�"�|�hI�?��'=0�̕b�154OS�����y,n      	   0   x���  �w�E�E@����0QA()=A��Y���7���{nf�?X      	   A   x�KI-��)M����4�*HM�L��4��*N��LI�44���K/J-��4�J��-(��r��qqq 1�=      	   .   x�3�44�440���34Գ0�4�2���Č-�M8��b���� �H      	   -   x�3�4�44�2�4�4�2��\&@1#. ��3��\1z\\\ ��;      (	   1   x�3�4�4�440�30 1�,���9A���"ll�gh����� ���      	   /   x�3��4�4�30�4�&��\f�Ɯ�� ���˘eb���� �a      *	   -   x�34�44�4�4�30 R&@�����$j�i	54���qqq ��r      	   4   x�3�4B#Cs]#]K.#tctC#.SNcN����@� �g�      $	   %   x�3�4�4�4204�5��5�@������\1z\\\ �d�      -	   <   x�3���K/J-�W(�/RJM/�I,ʬJL�<�9��.���������|xeW� ���      /	   9   x�3�N��LIT(�/RJM/�I,ʬJL�<�9��&��������|xeW� "9�      	      x������ � �      	       x�3��4�4204�5��5��������� 1��      	   s  x�u��n�0E��Wp��T�-RXF����4�K�"eJt��2����6R��sp.m];�,��8x�_����;����1S�����Ĕ��|���֪qK8Q��z�q��s(�]�z��y��JH
�!�tY.�'
	�c��|b7��mS+��0��R��^_��R\��X�0�[��w��o������;�ٰGJ��o7����u��c��o}�ƑGV�h��pW8�8���P��\0�n��v���|sӐ�D_wk�+\-������G?.�R��[%id�ڒǔid�l�*�D�,a�?���}��Wv�\z�8M>�Kf�0��� m��'y��@q��%��7�+�Tϻ��>���      	   �   x�]�1o�0��ǯ�d��mcUU]�*C�]�"TG�-�t7|�޻GW�_�T
�OpZ�J�(��u�uA��@��U��j-��;)��q�m?Ae-�Z�}z=��&5Ij�LJ��a ��6�o.y�o'�L�iL!��a�)��0���ܴ��]��v�.��Y�<ۓ0�[����_X\��R��Z}8$�J^f����لyxߏa\�&�������GE�kX�      	   g   x�ʽ@0 ���).����I�H��.A��c��1��S�[�p��fp�ʵ)��r��RwrP�*�c��/!��_[��ѹ⌡�۶R/���j�.E�f�      &	   +   x�34�4"N#N#Cs]K]NCdN��of����� �`�      !	   .   x�3���L�2��)�2�LO��2��N�2���2�L/����� �z!      "	   ^   x��̱�0C�����%{А���\�NŻ�%UF�@��x����/��9^t�T��	}��h����Q�����ƌ�����k�>Zk*�=�     