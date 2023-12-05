import BgComponent from "../components/backgroundImg/bgComponent";
import { Box, Button, Image, Text } from "@chakra-ui/react";
import Navbar from "../components/navbarSection/navbar";
function Stay() {
  // { slideImages, slide, travel, stay }
  // console.log(travel);


  return (


    <>
      <Navbar />

      <BgComponent
        heading="Maharashtra Institute of Technology World Peace University"
        subHeading="Where the WORLD is at Peace"
      />

      <br />




      {/* grid section  */}
      <br />
      <Box width={"88%"} margin={"auto"} marginTop={"20px"}>
        <Box
          height={"260px"}
          width={"100%"}
          display={"flex"}
          // justifyContent="space-evenly"
          marginBottom={"10px"}
          // border="4px solid red"
          gap="7px"
        >
          <Box
            display={"flex"}
            // width={"55%"}
            width={"50%"}
            height={"auto"}
            // border="2px solid black"
            backgroundPosition={"center"}
            backgroundRepeat={"no-repeat"}
            backgroundImage="url()"
          >
            <Box
              display={{
                base: "block",
                sm: "block",
                md: "flex",
                lg: "flex",
                xl: "flex",
                "2xl": "flex",
              }}
              marginTop={"10px"}
            // border="2px solid green"
            >
              
              <div style={{ position: 'relative', display: 'inline-block' }}>
                <Image
                  height={"250px"}
                  width={"550px"}
                  marginTop={"10px"}
                  marginLeft={"8px"}
                  verticalAlign={"center"}
                  src="https://mitwpu.edu.in/uploads/school/6378642d7fe181668834349.jpg"
                />
                
                <div
                  style={{
                    position: 'absolute',
                    top: '10%',
                    left: '50%',
                    transform: 'translate(-50%, -50%)',
                    color: 'white',
                    fontWeight:"bold",
                    fontSize: '18px',
                    zIndex: 2,

                  }}
                >
                  Our Culture
                </div>
              </div>

            </Box>
          </Box>
          <Box
            display={"flex"}
            // width={"55%"}
            width={"50%"}
            height={"auto"}
            // border="2px solid black"
            backgroundPosition={"center"}
            backgroundRepeat={"no-repeat"}
            backgroundImage="url()"
          >
            <Box
              display={{
                base: "block",
                sm: "block",
                md: "flex",
                lg: "flex",
                xl: "flex",
                "2xl": "flex",
              }}
              marginTop={"10px"}
            // border="2px solid green"
            >
              
              <div style={{ position: 'relative', display: 'inline-block' }}>
                <Image
                  height={"250px"}
                  width={"550px"}
                  marginTop={"10px"}
                  marginLeft={"8px"}
                  verticalAlign={"center"}
                  src="https://mitwpu.edu.in/uploads/events/Cover_RVK.webp"
                />
                
                <div
                  style={{
                    position: 'absolute',
                    top: '95%',
                    left: '50%',
                    transform: 'translate(-50%, -50%)',
                    color: 'Blue',
                    fontWeight:"bold",
                    fontSize: '18px',
                    zIndex: 2,

                  }}
                >
                  Our Events
                </div>
              </div>

            </Box>
          </Box>
        </Box>

        
      </Box>
    </>
  );
}

export default Stay;

